/**
 * DataTables Basic
 */

$(function () {
    'use strict';

    var sms_data_table = $('.sms_data_table'),
        assetPath = '../../../app-assets/';

    if ($('body').attr('data-framework') === 'laravel') {
        assetPath = $('body').attr('data-asset-path');
    }



    // Multilingual DataTable
    // --------------------------------------------------------------------

    var lang = 'German';
    if (sms_data_table.length) {

        var table_language = sms_data_table.DataTable({
            ajax: assetPath + 'data/call-list.json',
            columns: [
               // { data: 'id' },
                { data: 'from'},
                { data: 'to' },
                { data: 'Message' },

                { data: 'status' },
                { data: 'created_at' },
                { data: '' }
            ],

            columnDefs: [
                {
                    // For Responsive
                    className: 'control',
                    orderable: false,
                    targets: 0
                },

                {
                    // Actions
                    targets: -1,
                    title: 'Actions',
                    orderable: false,
                    render: function (data, type, full, meta) {
                        //console.log(full);
                        //debugger;

                        return (
                            '<div class="d-inline-flex">' +
                            '<a class="pr-1 dropdown-toggle hide-arrow text-primary" data-toggle="dropdown">' +
                            feather.icons['more-vertical'].toSvg({ class: 'font-small-4' }) +
                            '</a>' +
                            '<div class="dropdown-menu dropdown-menu-right">' +
                            '<a href="/sms/sms-detail/'+full.id+'" class="dropdown-item">' +
                            feather.icons['file-text'].toSvg({ class: 'mr-50 font-small-4' }) +
                            'Details</a>' +
                            '<a href="/sms/delete-sms/'+full.id+'" class="dropdown-item delete-record">' +
                            feather.icons['trash-2'].toSvg({ class: 'mr-50 font-small-4' }) +
                            'Delete</a>' +
                            '</div>' +
                            '</div>' +
                            '<a href="/sms/delete-sms/'+full.id+' "class="delete-record">' +
                            feather.icons['trash-2'].toSvg({ class: 'mr-50 font-small-4' }) +
                            '</a>'
                        );
                    }
                }
            ],
            language: {
                url: '//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/' + 'en' + '.json',
                paginate: {
                    // remove previous & next text from pagination
                    previous: '&nbsp;',
                    next: '&nbsp;'
                }
            },
            dom:
                '<"d-flex justify-content-between align-items-center mx-0 row"<"col-sm-12 col-md-6"l><"col-sm-12 col-md-6"f>>t<"d-flex justify-content-between mx-0 row"<"col-sm-12 col-md-6"i><"col-sm-12 col-md-6"p>>',
            displayLength: 7,
            lengthMenu: [7, 7, 25, 7, 5, 10]

        });
    }
});
