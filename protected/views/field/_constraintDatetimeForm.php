<?php
Yii::app()->clientScript->registerScript('switch-datetime-select', "
function toggleDatetime(object){
    var datatype = $('option:selected', object).val();
    var formatSelector = $('#ConstraintDatetime_format');
    $('optgroup', formatSelector).each(function(){ this.disabled = true; });
    var label = '';
    switch (datatype) {
        case 'D': label = 'Date'; break;
        case 't': label = 'Time'; break;
        case 'd': label = 'Datetime'; break;
    }
    var target = $('optgroup', formatSelector).filter(function(){return this.label===label});
    target.each(function(){
        this.disabled = false;
        $('option:first',this).each(function(){this.selected=true;});
    });
}
toggleDatetime($('#Field_datatype'));
$('#Field_datatype').change(function(){ toggleDatetime(this); });
");
?>
<?php
/**
 * @todo Enumerate available date, time, and datetime formats in a comprehensive manner.
 */
?>
<?php $timezoneSelect = array(
    'GMT-12.0' => '(GMT -12:00) Eniwetok, Kwajalein',
    'GMT-11.0' => '(GMT -11:00) Midway Island, Samoa',
    'GMT-10.0' => '(GMT -10:00) Hawaii',
    'GMT-9.0'  => '(GMT -9:00) Alaska',
    'GMT-8.0'  => '(GMT -8:00) Pacific Time (US & Canada)',
    'GMT-7.0'  => '(GMT -7:00) Mountain Time (US & Canada)',
    'GMT-6.0'  => '(GMT -6:00) Central Time (US & Canada), Mexico City',
    'GMT-5.0'  => '(GMT -5:00) Eastern Time (US & Canada), Bogota, Lima',
    'GMT-4.0'  => '(GMT -4:00) Atlantic Time (Canada), Caracas, La Paz',
    'GMT-3.5'  => '(GMT -3:30) Newfoundland',
    'GMT-3.0'  => '(GMT -3:00) Brazil, Buenos Aires, Georgetown',
    'GMT-2.0'  => '(GMT -2:00) Mid-Atlantic',
    'GMT-1.0'  => '(GMT -1:00 hour) Azores, Cape Verde Islands',
    'GMT+0.0'  => '(GMT) Western Europe Time, London, Lisbon, Casablanca',
    'GMT+1.0'  => '(GMT +1:00 hour) Brussels, Copenhagen, Madrid, Paris',
    'GMT+2.0'  => '(GMT +2:00) Kaliningrad, South Africa',
    'GMT+3.0'  => '(GMT +3:00) Baghdad, Riyadh, Moscow, St. Petersburg',
    'GMT+3.5'  => '(GMT +3:30) Tehran',
    'GMT+4.0'  => '(GMT +4:00) Abu Dhabi, Muscat, Baku, Tbilisi',
    'GMT+4.5'  => '(GMT +4:30) Kabul',
    'GMT+5.0'  => '(GMT +5:00) Ekaterinburg, Islamabad, Karachi, Tashkent',
    'GMT+5.5'  => '(GMT +5:30) Bombay, Calcutta, Madras, New Delhi',
    'GMT+5.75' => '(GMT +5:45) Kathmandu',
    'GMT+6.0'  => '(GMT +6:00) Almaty, Dhaka, Colombo',
    'GMT+7.0'  => '(GMT +7:00) Bangkok, Hanoi, Jakarta',
    'GMT+8.0'  => '(GMT +8:00) Beijing, Perth, Singapore, Hong Kong',
    'GMT+9.0'  => '(GMT +9:00) Tokyo, Seoul, Osaka, Sapporo, Yakutsk',
    'GMT+9.5'  => '(GMT +9:30) Adelaide, Darwin',
    'GMT+10.0' => '(GMT +10:00) Eastern Australia, Guam, Vladivostok',
    'GMT+11.0' => '(GMT +11:00) Magadan, Solomon Islands, New Caledonia',
    'GMT+12.0' => '(GMT +12:00) Auckland, Wellington, Fiji, Kamchatka',
);
?>
<?php 
/**
 * @todo Switch options based on data type: time date datetime
 * 
 * By default, all date numbers are zero trimmed.
 * Here are the list of characters to use
 * +--------+-----------------------------+-------------+
 * |        |           Numeric           |     Word    | 
 * +        +-----------------------------+-------------+
 * |        | zero leading | Zero trimmed | Full | Abbr |
 * +--------+--------------+--------------+------+------+
 * | Hour   | H / h        | G /g         | A (AM/PM)   |
 * +--------+--------------+--------------+------+------+
 * | Minute | i            | -            | -           |
 * +--------+--------------+--------------+------+------+
 * | Second | s            | -            | -           |
 * +--------+--------------+--------------+------+------+
 * | Day    | d            | j            | S (ordinal) |
 * +--------+--------------+--------------+------+------+
 * | Month  | n            | m            | F    | M    |
 * +--------+--------------+--------------+------+------+
 * | Year   | Y (w/century)| y (w/out century)          |
 * +--------+--------------+--------------+------+------+
 */
$formatSelect = array(
    'Date' => array(
            'm/j/Y'     => date('m/j/Y'), // 5/13/2012
            'l, F j, Y' => date('l, F j, Y'), // Sunday, May 13, 2012
            'Y-n-j'     => date('Y-n-j'), // 2012-05-13
            'j-F-y'     => date('j-F-y'), // 13-May-12
            'm.j.Y'     => date('m.j.Y'), // 5.13.2012
            'M j, y'    => date('M j, y'), // May. 13, 12
            'j F Y'     => date('j F Y'), // 13 May 2012
            'F-y'       => date('F-y'), // May-12 (Month-Year)
            'F j, Y'    => date('F j, Y'), // May 13, 2012
            'm/j/y'     => date('m/j/y'), // 5/13/12
            'm/j'       => date('m/j'), // 5/13
            'j F, Y'    => date('j F, Y'), // 13 May, 2012
            'j/m/y'     => date('j/m/y'), // 13/5/12
            'j/m'       => date('j/m'), // 13/5
            'y/m/j'     => date('y/m/j'), // 12/5/13
            'Y/m/j'     => date('Y/m/j'), // 2012/5/13
            'm/y'       => date('m/y').' (month/year)', // 5/12 (Month/Year)
            'm/Y'       => date('m/Y'), // 5/2012
            'F Y'       => date('F Y'), // May 2012
            'F y'       => date('F y').' (month year)', // May 12 (Month Year)
            'y'         => date('y').' (year)', // 12 (Year, 2 Digits)
            'Y'         => date('Y'), // 2012
            'j'         => date('j').' (day)', // 13 (Day)
            'F'         => date('F'), // May
            'm'         => date('m').' (month)', // 5 (Month)
        ),

    'Time' => array(
            'H:i'     => date('H:i'), // 21:26
            'H:i:s'   => date('H:i:s'), // 21:26:41
            'h:i A'   => date('h:i A'), // 9:26 PM
            'h:i:s A' => date('h:i:s A'), // 9:26:41
        ),

    'Datetime' => array(
            'm/j/Y h:i A'   => date('m/j/Y h:i A'), // 5/13/2012 9:26 PM
            'm/j/Y h:i:s A' => date('m/j/Y h:i:s A'), // 5/13/2012 9:26:41 PM
        ),
);
?>
<?php echo $form->dropDownListRow($constraintDatetimeModel,'format',$formatSelect); ?>
<?php echo $form->dropDownListRow($constraintDatetimeModel,'timezone',$timezoneSelect,array(
    'options' => array( 'GMT+0.0' => array( 'selected' => true, ), ),
)); ?>
<?php echo $form->textFieldRow($constraintDatetimeModel,'default_value'); ?>
