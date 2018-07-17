import * as $ from 'jquery';
import 'datatables';

export default (function () {
    $('.ajax-dataTable').each(function(){
        $(this).DataTable( {
            "processing": true,
            "serverSide": true,
            "ajax": {
                "url":$(this).data('url'),
                "dataType": "json",
            },
            "columnDefs": $(this).data('column-defs'),
            // "columns": [
            //     { data: 'name', name: 'name' },
            //     { data: 'name', name: 'name' },
            //     { data: 'name', name: 'name' },
            //     { data: 'name', name: 'name' },
            //     { data: 'name', name: 'name' },
            //     { data: 'name', name: 'name' },
            // ]
        } );
    });
}());
