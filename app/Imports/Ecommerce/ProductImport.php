<?php

namespace App\Imports\Ecommerce;

use App\Http\Exceptions\ApiException;
use App\Models\Ecommerce\Product;
use DB;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Validator as Validator;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\SkipsEmptyRows;
use Maatwebsite\Excel\Concerns\SkipsErrors;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Validators\Failure;

class ProductImport implements ToCollection, WithHeadingRow, SkipsOnError, SkipsOnFailure, SkipsEmptyRows
{
    use Importable, SkipsErrors;

    public function collection(Collection $rows)
    {
        $completed = false;
        $rowIndex  = 0;
        try {
            $createRecords = [];
            $rows->each(function ($row, $idx) use (&$createRecords) {
                if (!$row['name_en']) {
                    return;
                }

                $rowIndex = $idx + 1;
                $rowArray = $row->toArray();

                $validator = Validator::make($rowArray, [
                    'name_en'        => ['required', 'string', 'max:190'],
                    'name_ar'        => ['required', 'string', 'max:190'],
                    'description_en' => ['nullable', 'string', 'max:4000'],
                    'description_ar' => ['nullable', 'string', 'max:4000'],
                    'subtitle_en'    => ['nullable', 'string', 'max:190'],
                    'subtitle_ar'    => ['nullable', 'string', 'max:190'],
                    'price'          => ['required', 'numeric', 'min:1'],
                    'cost'           => ['nullable', 'numeric'],
                    'stock_qty'      => ['nullable', 'numeric'],
                    'featured'       => ['nullable'],
                    'youtube_video'  => ['nullable'],
                ]);

                if ($validator->fails()) {
                    throw new ApiException(json_encode([
                        'errors' => $validator->errors(),
                        'row'    => $rowIndex,
                    ]));
                }

                $cost            = isset($row['cost']) && $row['cost'] ? $row['cost'] : 0;
                $createRecords[] = [
                    'price'         => $row['price'],
                    'cost'          => $cost,
                    'net'           => +$row['price'] - $cost,
                    'stock_qty'     => isset($row['stock_qty']) && $row['stock_qty'] ? $row['stock_qty'] : 1,
                    'featured'      => isset($row['featured']) && booleanish($row['featured']) ? true : false,
                    'youtube_video' => isset($row['youtube_video']) && $row['youtube_video'] ? $row['youtube_video'] : null,
                    'en'            => [
                        'name'        => $row['name_en'],
                        'description' => isset($row['description_en']) && $row['description_en'] ? $row['description_en'] : '',
                        'subtitle'    => isset($row['subtitle_en']) && $row['subtitle_en'] ? $row['subtitle_en'] : '',
                    ],
                    'ar'            => [
                        'name'        => $row['name_ar'],
                        'description' => isset($row['description_ar']) && $row['description_ar'] ? $row['description_ar'] : '',
                        'subtitle'    => isset($row['subtitle_ar']) && $row['subtitle_ar'] ? $row['subtitle_ar'] : '',
                    ],
                ];
            });

            DB::BeginTransaction();
            $rowIndex = 1;
            foreach ($createRecords as $recordData) {
                $rowIndex++;
                $record = Product::create($recordData);
            }
            DB::commit();
            $completed = true;
        } catch (\Throwable $th) {
            DB::rollback();
            logger("{$th->getMessage()} {$th->getFile()} {$th->getMessage()}");
            if ($th instanceof ApiException) {
                throw $th;
            }
        }
        if (!$completed) {
            throw new ApiException(json_encode([
                'errors' => [1 => 'Something went wrong.'],
                'row'    => $rowIndex,
            ]));
        }
    }

    /**
     * @param Failure[] $failures
     */
    public function onFailure(Failure...$failures)
    {
        // Handle the failures how you'd like.
        // dd($failures);
    }

    /**
     * @param \Throwable $e
     */
    public function onError(\Throwable $e)
    {
        // Handle the exception how you'd like.
    }
}
