/**
 * DataTables Basic
 */

$(function () {
    'use strict';

    var dt_date_table = $('.dt-date'),
        dt_multilingual_table = $('.dt-multilingual'),
        assetPath = '../../../app-assets/';

    if ($('body').attr('data-framework') === 'laravel') {
        assetPath = $('body').attr('data-asset-path');
    }


    // Flat Date picker
    if (dt_date_table.length) {
        dt_date_table.flatpickr({
            monthSelectorType: 'static',
            dateFormat: 'm/d/Y'
        });
    }


    // Multilingual DataTable
    // --------------------------------------------------------------------

    var lang = 'German';
    if (dt_multilingual_table.length) {
        var table_language = dt_multilingual_table.DataTable({
            ajax: assetPath + 'data/contact-list.json',
            columns: [
                { data: 'id' },
                { data: 'first_name'},
                { data: 'company_name' },
                { data: 'email' },
                { data: 'mobile_phone' },
                { data: 'home_phone' },
                { data: 'work_phone' },
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
                            '<a href="/contacts/contact-detail/'+full.id+'" class="dropdown-item">' +
                            feather.icons['file-text'].toSvg({ class: 'mr-50 font-small-4' }) +
                            'Details</a>' +
                            '<a href="/contacts/delete-contact/'+full.id+'" class="dropdown-item delete-record">' +
                            feather.icons['trash-2'].toSvg({ class: 'mr-50 font-small-4' }) +
                            'Delete</a>' +
                            '</div>' +
                            '</div>' +
                            '<a href="/contacts/update-contact/'+full.id+' "class="item-edit">' +
                            feather.icons['edit'].toSvg({ class: 'font-small-4' }) +
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
            lengthMenu: [7, 10, 25, 50, 75, 100],
            responsive: {
                details: {
                    display: $.fn.dataTable.Responsive.display.modal({
                        header: function (row) {
                            var data = row.data();
                            return 'Details of ' + data['full_name'];
                        }
                    }),
                    type: 'column',
                    renderer: $.fn.dataTable.Responsive.renderer.tableAll({
                        tableClass: 'table'
                    })
                }
            }
        });
    }
});
