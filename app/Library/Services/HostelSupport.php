<?php

namespace App\Library\Services;

use Carbon\Carbon;
use Illuminate\Support\Facades\Session;
use DB;
use App\Models\Hostel;
use App\Models\HostelRoom;
use App\Models\User;
use Illuminate\Database\QueryException;
use App\Mail\HostelWasDisabled;
use App\Mail\HostelWasDeleted;
use App\Mail\ReportToSupportOnAction;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithPreCalculateFormulas;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Events\BeforeExport;
use Maatwebsite\Excel\Events\BeforeWriting;
use Maatwebsite\Excel\Imports\HeadingRowFormatter;

use Maatwebsite\Excel\Events\BeforeSheet;

use \Maatwebsite\Excel\Sheet;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithMapping;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;

class HostelSupport
{

    public function export(

        array $hostelIds,
        $output_format = 'scv'
    ) {
        createDir([storage_path('app/public/tmp')], 0755);
        $tmp_dest = 'public/tmp/';
        \Log::info(varDump($hostelIds, ' -1 export $hostelIds::'));
//        \Log::info(varDump($output_format, ' -1 export $output_format::'));
        $filename_to_save = 'hostels-export.' . $output_format;

        $save_to_filename           = substr(Session::getId(), 0, 20) . '-' . $filename_to_save;
        $save_to_filename_full_path = $tmp_dest . $save_to_filename;

        \Excel::store(new HostelsByIdExport($hostelIds), $save_to_filename_full_path);

        return [
            'success'          => true,
            'save_to_filename' => $save_to_filename,
        ];
    }

    public function delete(
        array $hostelIds,
        $raise_error_non_existing = false,
        $send_message_to_creator = false,
        $send_message_to_support = false,
        $message_to_creator = ''
    ) {


        \Log::info(varDump($message_to_creator, ' -1 delete $message_to_creator::'));
        \Log::info(varDump($raise_error_non_existing, ' -1 delete $raise_error_non_existing::'));
        try {
            $sendEmails = [];
            DB::beginTransaction();
            foreach ($hostelIds as $next_hostel_id) {
                \Log::info(varDump($next_hostel_id, ' -10 delete $next_hostel_id::'));
                $hostel = Hostel::find($next_hostel_id);
                if (empty($hostel)) {
                    if ( ! $raise_error_non_existing) {
                        continue;
                    } else {
                        DB::rollBack();

                        return [
                            'success' => false,
                            'message' => 'Hostel # ' . $next_hostel_id . ' not found!',
                        ];
                    }
                }
                \Log::info(varDump($hostel->id, ' -1 delete HostelSupport $hostel->id::'));

/*                $hostel->status     = 'I'; //-Inactive;
                $hostel->updated_at = Carbon::now(config('app.timezone'));
                $hostel->save();*/
                $hostel->delete();

                $email_to_sent = $hostel->email;
                \Log::info(varDump($hostel->user, ' -1 $hostel->user::'));
                if (empty($email_to_sent)) {
                    $hostelUser    = User::find($hostel->user->id);
                    $email_to_sent = $hostelUser->email;
                }
                \Log::info(varDump($email_to_sent, ' -1 $email_to_sent::'));
//                $email_to_sent = 'nilov@softreactor.com'; // DEBUG

                $sendEmails[] = [
                    'hostel'        => $hostel,
                    'hostelCreator' => $hostel->user,
                    'email_to_sent' => $email_to_sent,
                ];
            } // foreach( $hostelIds as $next_key=>$next_hostel_id ) {

            DB::commit();
            if ($send_message_to_creator and count($sendEmails) > 0) {
                //     public function __construct($hostel, $hostelCreator, $message_to_creator = '')
                foreach ($sendEmails as $nextSendEmail) {
//                    \Mail::to($nextSendEmail['email_to_sent'])->send(new HostelWasDisabled($nextSendEmail['hostel'],
//                        $nextSendEmail['hostelCreator'], $message_to_creator));
                    \Mail::to($nextSendEmail['email_to_sent'])->send(new HostelWasDeleted($nextSendEmail['hostel'],
                        $nextSendEmail['hostelCreator'], $message_to_creator));

                }
            }
            if ($send_message_to_support) {
                $support_email = config('app.support_email');
                foreach ($sendEmails as $nextSendEmail) {
                    \Mail::to($support_email)->send(new ReportToSupportOnAction($nextSendEmail['hostel'],
                        $nextSendEmail['hostelCreator'], 'Hostel was deleted', $message_to_creator));

//                    \Mail::to($support_email)->send(new ReportToSupportOnAction($nextSendEmail['hostel'],
//                        $nextSendEmail['hostelCreator'], 'Hostel was disabled', $message_to_creator));
                }
            }
        } catch (QueryException $e) {
            DB::rollBack();

            return [
                'success' => false,
                'message' => 'Run time error : ' . $e->getMessage(),
            ];
        }

        return [
            'success' => true,
        ];

//        \Log::info(varDump($message_to_creator, ' -1 delete $message_to_creator::'));
//        \Log::info(varDump($raise_error_non_existing, ' -1 delete $raise_error_non_existing::'));
/*        try {
            $sendEmails = [];
            DB::beginTransaction();
            foreach ($hostelIds as $next_hostel_id) {
                $hostel = Hostel::find($next_hostel_id);
                if (empty($hostel)) {
                    if ( ! $raise_error_non_existing) {
                        continue;
                    } else {
                        DB::rollBack();

                        return [
                            'success' => false,
                            'message' => 'Hostel # ' . $next_hostel_id . ' not found!',
                        ];
                    }
                }
                $hostel->delete();

                $email_to_sent = $hostel->email;
                if (empty($email_to_sent)) {
                    $hostelUser    = User::find($hostel->user->id);
                    $email_to_sent = $hostelUser->email;
                }
                $sendEmails[] = [
                    'hostel'        => $hostel,
                    'hostelCreator' => $hostel->user,
                    'email_to_sent' => $email_to_sent,
                ];
            } // foreach( $hostelIds as $next_key=>$next_hostel_id ) {

            DB::commit();
            if ($send_message_to_creator and count($sendEmails) > 0) {
                foreach ($sendEmails as $nextSendEmail) {
                    \Mail::to($nextSendEmail['email_to_sent'])->send(new HostelWasDeleted($nextSendEmail['hostel'],
                        $nextSendEmail['hostelCreator'], $message_to_creator));
                }
            }
            if ($send_message_to_support) {
                $support_email = config('app.support_email');
                foreach ($sendEmails as $nextSendEmail) {
                    \Mail::to($support_email)->send(new ReportToSupportOnAction($nextSendEmail['hostel'],
                        $nextSendEmail['hostelCreator'], 'Hostel was deleted', $message_to_creator));
                }
            }
        } catch (QueryException $e) {
            DB::rollBack();

            return [
                'success' => false,
                'message' => 'Run time error : ' . $e->getMessage(),
            ];
        }

        return [
            'success' => true,
        ];*/


    } // public function delete( array $hostelIds, $raise_error_non_existing = false, $send_message_to_creator = false, $send_message_to_support = false, $message_to_creator = '')


    public function disable(
        array $hostelIds,
        $raise_error_non_existing = false,
        $send_message_to_creator = false,
        $send_message_to_support = false,
        $message_to_creator = ''
    ) {
        \Log::info(varDump($message_to_creator, ' -1 disable $message_to_creator::'));
        \Log::info(varDump($raise_error_non_existing, ' -1 disable $raise_error_non_existing::'));
        try {
            $sendEmails = [];
            DB::beginTransaction();
            foreach ($hostelIds as $next_hostel_id) {
                \Log::info(varDump($next_hostel_id, ' -10 disable $next_hostel_id::'));
                $hostel = Hostel::find($next_hostel_id);
                if (empty($hostel)) {
                    if ( ! $raise_error_non_existing) {
                        continue;
                    } else {
                        DB::rollBack();

                        return [
                            'success' => false,
                            'message' => 'Hostel # ' . $next_hostel_id . ' not found!',
                        ];
                    }
                }
                \Log::info(varDump($hostel->id, ' -1 disable HostelSupport $hostel->id::'));
                $hostel->status     = 'I'; //-Inactive;
                $hostel->updated_at = Carbon::now(config('app.timezone'));
                $hostel->save();

                $email_to_sent = $hostel->email;
                \Log::info(varDump($hostel->user, ' -1 $hostel->user::'));
                if (empty($email_to_sent)) {
                    $hostelUser    = User::find($hostel->user->id);
                    $email_to_sent = $hostelUser->email;
                }
                \Log::info(varDump($email_to_sent, ' -1 $email_to_sent::'));
//                $email_to_sent = 'nilov@softreactor.com'; // DEBUG

                $sendEmails[] = [
                    'hostel'        => $hostel,
                    'hostelCreator' => $hostel->user,
                    'email_to_sent' => $email_to_sent,
                ];
            } // foreach( $hostelIds as $next_key=>$next_hostel_id ) {

            DB::commit();
            if ($send_message_to_creator and count($sendEmails) > 0) {
                //     public function __construct($hostel, $hostelCreator, $message_to_creator = '')
                foreach ($sendEmails as $nextSendEmail) {
                    \Mail::to($nextSendEmail['email_to_sent'])->send(new HostelWasDisabled($nextSendEmail['hostel'],
                        $nextSendEmail['hostelCreator'], $message_to_creator));
                }
            }
            if ($send_message_to_support) {
                $support_email = config('app.support_email');
                foreach ($sendEmails as $nextSendEmail) {
                    \Mail::to($support_email)->send(new ReportToSupportOnAction($nextSendEmail['hostel'],
                        $nextSendEmail['hostelCreator'], 'Hostel was disabled', $message_to_creator));
                }
            }
        } catch (QueryException $e) {
            DB::rollBack();

            return [
                'success' => false,
                'message' => 'Run time error : ' . $e->getMessage(),
            ];
        }

        return [
            'success' => true,
        ];

    } // public function disable(array $hostelIds, $raise_error_non_existing = false,$send_message_to_creator = false, $send_message_to_support = false, $message_to_creator = '')


}


class HostelsByIdExport implements FromCollection, WithEvents, WithHeadings, WithPreCalculateFormulas, WithColumnFormatting, ShouldAutoSize, WithColumnWidths, WithStyles
{
    private $hostelsList;

    public function __construct(array $hostelsList)
    {
        $this->hostelsList = $hostelsList;
        \Log::info(varDump($hostelsList, ' -1 HostelsByIdExport $hostelsList::'));
//        sheet
        // https://stackoverflow.com/questions/42202357/set-paper-width-in-laravel-excel
    }

    public function headings(): array
    {
        return [    // https://docs.laravel-excel.com/3.1/exports/mapping.html
                    '#',     // A
                    'Name', // B
                    'Status',  // C
                    'Location',  // D
                    'Street',  // F
                    'Phone',  // G
                    'Email',  // H
                    'Feature',  // I
                    'Min price for room',  // J
                    'Short description',  // K
                    'Creator id',  // L
                    'Creator name',  // M
                    'Created at',  // N
        ];
    }

    public function collection()
    {
        return Hostel
            ::getById($this->hostelsList)
            ->with('user')
            ->with('state')
            ->with('region')
            ->with('subregion')
            ->orderBy('created_at', 'desc')
            ->addSelect([
                'min_hostel_rooms_price' =>
                    HostelRoom::query()
                              ->selectRaw('MIN(price)')
                              ->whereColumn('hostel_id', 'hostels.id'),
            ])
            ->get()
            ->map(function ($hostelItem) {
                return [
                    'id'                     => $hostelItem->id,
                    // A
                    'name'                   => $hostelItem->name,
                    // B
                    'status'                 => Hostel::getHostelStatusLabel($hostelItem->status),
                    // C
                    'location'               => $hostelItem->state->name . ', ' . $hostelItem->region->name . ', ' . $hostelItem->subregion->name . ', ' . $hostelItem->town,
                    // D
                    'street_addr'            => $hostelItem->street_addr,
                    // F
                    'phone'                  => $hostelItem->phone,
                    // G
                    'email'                  => $hostelItem->email,
                    // H
                    'feature'                => Hostel::getHostelFeatureLabel($hostelItem->feature),
                    //I
                    'min_hostel_rooms_price' => formatCurrencySum($hostelItem->min_hostel_rooms_price),
                    // J
                    // K
                    'creator_id'             => $hostelItem->user->id,
                    // L
                    'creator_name'           => $hostelItem->user->name,
                    // M
                    'created_at'             => $hostelItem->created_at,
                    // N
                ];
            });
    }

    public function registerEvents(): array
    {
        return [
            // Handle by a closure.
            BeforeExport::class  => function (BeforeExport $event) {
                $event->writer->getProperties()->setCreator(\Auth::user()->name);
            },


            // Array callable, refering to a static method.
            BeforeWriting::class => [self::class, 'beforeWriting'],

            AfterSheet::class => function (AfterSheet $event) {
                $event->sheet  ->getPageSetup()->setOrientation(\PhpOffice\PhpSpreadsheet\Worksheet\PageSetup::ORIENTATION_LANDSCAPE);
//                $event->sheet  ->getPageSetup()->setOrientation(\PhpOffice\PhpSpreadsheet\Worksheet\PageSetup::ORIENTATION_PORTRAIT);
                // https://docs.laravel-excel.com/3.1/exports/extending.html

/*                $event->sheet->styleCells(
                    'B2:G8',
                    [
                        'borders' => [
                            'outline' => [
                                'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK,
                                'color' => ['argb' => 'FFFF0000'],
                            ],
                        ]
                    ]
                );*/


            }, // AfterSheet::class => function (AfterSheet $event) {

        ];
    }

    public static function beforeWriting(BeforeWriting $event)
    {
        \Log::info(varDump(-1, ' -1 beforeWriting $event::'));
    }

    public function columnFormats(): array
    {
        return [
            'I' => NumberFormat::FORMAT_CURRENCY_USD,   // min price
        ];
    }

    public function columnWidths(): array
    {
        return [
            'J' => 60, // Short description
        ];
    }

    public function styles(Worksheet $sheet)
    {
//        $sheet->setPaperSize(PHPExcel_Worksheet_PageSetup::PAPERSIZE_A3);

/*        $highestRow             = $sheet->getHighestRow();
        $footerIndentRows       = 2;
        $footerSummeryRowNumber = $highestRow + $footerIndentRows;

        $priceSummaryCell = 'G' . ($footerSummeryRowNumber);
        $sheet->getStyle($priceSummaryCell)->getFont()->setBold(true);
        \Log::info(varDump($priceSummaryCell, ' -1 $priceSummaryCell::'));

        return [
            // Style the first row as bold text.
            //            1    => ['font' => ['bold' => true]],

            // Styling a specific cell by coordinate.
            $priceSummaryCell => ['font' => ['italic' => true, 'bold' => true]],

            // Styling an entire column.
            'I'               => ['font' => ['size' => 14]], // Price
        ];*/
    }

    public function drawings()
    {
        /*        \DB::table('settings')->insert([
            'name' => 'app_medium_logo',
            'value' =>  'logo_64.png',
        ]);
 */
/*        $drawing = new Drawing();
        $drawing->setName('Logo');
        $drawing->setDescription('This is my logo');
        $drawing->setPath(public_path('/img/logo.jpg'));
        $drawing->setHeight(50);
        $drawing->setCoordinates('B16');

        $drawing2 = new Drawing();
        $drawing2->setName('Other image');
        $drawing2->setDescription('This is a second image');
        $drawing2->setPath(public_path('/img/other.jpg'));
        $drawing2->setHeight(120);
        $drawing2->setCoordinates('G18');

        return [$drawing, $drawing2];*/
    }

}
