$('#btn-flight-new-cancel').click(function(){
    $('#data').load('modules/flight_edit.php');
});

$('#btn-flight-create-ok').click(function(){
    if (!validate()) return false;
    var time_dep = $('#time_dep').val();
    var time_arr = $('#time_arr').val();
    var point_dep = $('#point_dep').val();
    var point_arr = $('#point_arr').val();
    var place = $('#place').val();
    
    var data = {add:'1',time_dep:time_dep,time_arr:time_arr,point_dep:point_dep,point_arr:point_arr,place:place};
    var object = JSON.stringify(data);
    var title = 'Добавление рейса';
    var message = 'Добавить рейс: ';
    message += '<br/>Время вылета: ' + time_dep;
    message += '<br/>Время прилета: ' + time_arr;
    message += '<br/>Пункт вылета: ' + point_dep;
    message += '<br/>Пункт прилета: ' + point_arr;
    message += '<br/>Количество мест: ' + place;
    var targetOk = 'modules/flight_edit.php';
    var targetCancel = 'modules/flight_edit.php';
    confirm(title, message, object, targetOk, targetCancel);
});


$('#time_dep').timepicker({
    // Options
    timeSeparator: ':',           // The character to use to separate hours and minutes. (default: ':')
    showLeadingZero: true,        // Define whether or not to show a leading zero for hours < 10.
                                 
    showMinutesLeadingZero: true, // Define whether or not to show a leading zero for minutes < 10.
                                     
    showPeriod: false,            // Define whether or not to show AM/PM with selected time. (default: false)
    showPeriodLabels: true,       // Define if the AM/PM labels on the left are displayed. (default: true)
    periodSeparator: ' ',         // The character to use to separate the time from the time period.
    altField: '#alternate_input', // Define an alternate input to parse selected time to
    defaultTime: '12:34',         // Used as default time when input field is empty or for inline timePicker
                                  // (set to 'now' for the current time, '' for no highlighted time,
                                   

    // trigger options
    showOn: 'focus',              // Define when the timepicker is shown.
                                  // 'focus': when the input gets focus, 'button' when the button trigger element is clicked,
                                  // 'both': when the input gets focus and when the button is clicked.
    button: null,                 // jQuery selector that acts as button trigger. ex: '#trigger_button'

    // Localization
    hourText: 'Hour',             // Define the locale text for "Hours"
    minuteText: 'Minute',         // Define the locale text for "Minute"
    amPmText: ['AM', 'PM'],       // Define the locale text for periods

    // Position
    myPosition: 'left top',       // Corner of the dialog to position, used with the jQuery UI Position utility if present.
    atPosition: 'left bottom',    // Corner of the input to position

    
    // custom hours and minutes
    hours: {
        starts: 0,                // First displayed hour
        ends: 23                  // Last displayed hour
    },
    minutes: {
        starts: 0,                // First displayed minute
        ends: 55,                 // Last displayed minute
        interval: 5,              // Interval of displayed minutes
        manual: []                // Optional extra entries for minutes
    },
    rows: 4,                      // Number of rows for the input tables, minimum 2, makes more sense if you use multiple of 2
    showHours: true,              // Define if the hours section is displayed or not. Set to false to get a minute only dialog
    showMinutes: true,            // Define if the minutes section is displayed or not. Set to false to get an hour only dialog

    /*
    // Min and Max time
    minTime: {                    // Set the minimum time selectable by the user, disable hours and minutes
        hour: minHour,            // previous to min time
        minute: minMinute
    },
    maxTime: {                    // Set the minimum time selectable by the user, disable hours and minutes
        hour: maxHour,            // after max time
        minute: maxMinute
    },
    */

    // buttons
    showCloseButton: false,       // shows an OK button to confirm the edit
    closeButtonText: 'Done',      // Text for the confirmation button (ok button)
    showNowButton: false,         // Shows the 'now' button
    nowButtonText: 'Now',         // Text for the now button
    showDeselectButton: false,    // Shows the deselect time button
    deselectButtonText: 'Deselect' // Text for the deselect button

});


$('#time_arr').timepicker({
    // Options
    timeSeparator: ':',           // The character to use to separate hours and minutes. (default: ':')
    showLeadingZero: true,        // Define whether or not to show a leading zero for hours < 10.
                                   
    showMinutesLeadingZero: true, // Define whether or not to show a leading zero for minutes < 10.
                                    
    showPeriod: false,            // Define whether or not to show AM/PM with selected time. (default: false)
    showPeriodLabels: true,       // Define if the AM/PM labels on the left are displayed. (default: true)
    periodSeparator: ' ',         // The character to use to separate the time from the time period.
    altField: '#alternate_input', // Define an alternate input to parse selected time to
    defaultTime: '12:34',         // Used as default time when input field is empty or for inline timePicker
                                  // (set to 'now' for the current time, '' for no highlighted time,
                                    

    // trigger options
    showOn: 'focus',              // Define when the timepicker is shown.
                                  // 'focus': when the input gets focus, 'button' when the button trigger element is clicked,
                                  // 'both': when the input gets focus and when the button is clicked.
    button: null,                 // jQuery selector that acts as button trigger. ex: '#trigger_button'

    // Localization
    hourText: 'Hour',             // Define the locale text for "Hours"
    minuteText: 'Minute',         // Define the locale text for "Minute"
    amPmText: ['AM', 'PM'],       // Define the locale text for periods

    // Position
    myPosition: 'left top',       // Corner of the dialog to position, used with the jQuery UI Position utility if present.
    atPosition: 'left bottom',    // Corner of the input to position

    
    // custom hours and minutes
    hours: {
        starts: 0,                // First displayed hour
        ends: 23                  // Last displayed hour
    },
    minutes: {
        starts: 0,                // First displayed minute
        ends: 55,                 // Last displayed minute
        interval: 5,              // Interval of displayed minutes
        manual: []                // Optional extra entries for minutes
    },
    rows: 4,                      // Number of rows for the input tables, minimum 2, makes more sense if you use multiple of 2
    showHours: true,              // Define if the hours section is displayed or not. Set to false to get a minute only dialog
    showMinutes: true,            // Define if the minutes section is displayed or not. Set to false to get an hour only dialog

    // Min and Max time
    /*
    minTime: {                    // Set the minimum time selectable by the user, disable hours and minutes
        hour: minHour,            // previous to min time
        minute: minMinute
    },
    maxTime: {                    // Set the minimum time selectable by the user, disable hours and minutes
        hour: maxHour,            // after max time
        minute: maxMinute
    },
    */

    // buttons
    showCloseButton: false,       // shows an OK button to confirm the edit
    closeButtonText: 'Done',      // Text for the confirmation button (ok button)
    showNowButton: false,         // Shows the 'now' button
    nowButtonText: 'Now',         // Text for the now button
    showDeselectButton: false,    // Shows the deselect time button
    deselectButtonText: 'Deselect' // Text for the deselect button

});

