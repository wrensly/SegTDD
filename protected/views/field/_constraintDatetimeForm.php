<?php $timezoneSelect = array(
      'GMT-12.0' => '(GMT -12:00) Eniwetok, Kwajalein',
      'GMT-11.0' => '(GMT -11:00) Midway Island, Samoa',
      'GMT-10.0' => '(GMT -10:00) Hawaii',
      'GMT-9.0' => '(GMT -9:00) Alaska',
      'GMT-8.0' => '(GMT -8:00) Pacific Time (US & Canada)',
      'GMT-7.0' => '(GMT -7:00) Mountain Time (US & Canada)',
      'GMT-6.0' => '(GMT -6:00) Central Time (US & Canada), Mexico City',
      'GMT-5.0' => '(GMT -5:00) Eastern Time (US & Canada), Bogota, Lima',
      'GMT-4.0' => '(GMT -4:00) Atlantic Time (Canada), Caracas, La Paz',
      'GMT-3.5' => '(GMT -3:30) Newfoundland',
      'GMT-3.0' => '(GMT -3:00) Brazil, Buenos Aires, Georgetown',
      'GMT-2.0' => '(GMT -2:00) Mid-Atlantic',
      'GMT-1.0' => '(GMT -1:00 hour) Azores, Cape Verde Islands',
      'GMT+0.0' => '(GMT) Western Europe Time, London, Lisbon, Casablanca',
      'GMT+1.0' => '(GMT +1:00 hour) Brussels, Copenhagen, Madrid, Paris',
      'GMT+2.0' => '(GMT +2:00) Kaliningrad, South Africa',
      'GMT+3.0' => '(GMT +3:00) Baghdad, Riyadh, Moscow, St. Petersburg',
      'GMT+3.5' => '(GMT +3:30) Tehran',
      'GMT+4.0' => '(GMT +4:00) Abu Dhabi, Muscat, Baku, Tbilisi',
      'GMT+4.5' => '(GMT +4:30) Kabul',
      'GMT+5.0' => '(GMT +5:00) Ekaterinburg, Islamabad, Karachi, Tashkent',
      'GMT+5.5' => '(GMT +5:30) Bombay, Calcutta, Madras, New Delhi',
      'GMT+5.75' => '(GMT +5:45) Kathmandu',
      'GMT+6.0' => '(GMT +6:00) Almaty, Dhaka, Colombo',
      'GMT+7.0' => '(GMT +7:00) Bangkok, Hanoi, Jakarta',
      'GMT+8.0' => '(GMT +8:00) Beijing, Perth, Singapore, Hong Kong',
      'GMT+9.0' => '(GMT +9:00) Tokyo, Seoul, Osaka, Sapporo, Yakutsk',
      'GMT+9.5' => '(GMT +9:30) Adelaide, Darwin',
      'GMT+10.0' => '(GMT +10:00) Eastern Australia, Guam, Vladivostok',
      'GMT+11.0' => '(GMT +11:00) Magadan, Solomon Islands, New Caledonia',
      'GMT+12.0' => '(GMT +12:00) Auckland, Wellington, Fiji, Kamchatka',
);
?>
<?php echo $form->textFieldRow($constraintDatetimeModel,'format'); ?>
<?php echo $form->dropDownListRow($constraintDatetimeModel,'timezone',$timezoneSelect,array(
      'options' => array( 'GMT+0.0' => array( 'selected' => true, ), ),
)); ?>
<?php echo $form->textFieldRow($constraintDatetimeModel,'default_value'); ?>