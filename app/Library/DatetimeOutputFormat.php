<?php namespace App\Library {

    use WBoyz\LaravelEnum\BaseEnum;

    class DatetimeOutputFormat extends BaseEnum
    {
        const dofAgoFormat = 'ago_format'; //             if ($output_format == 'ago_format') {

        const dofAsText = 'astext';
        const dofAsNumbers = 'numbers';
//        const ltPersonal = 'personal';
    }

}
