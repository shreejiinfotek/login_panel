<table id="myDataTable">
    <thead>
        <tr>
            <th>State</th>
            <th>City</th>
            <th>Zip</th>
            <th>Combined Exp</th>
        </tr>
    </thead>
    <tbody></tbody>
</table>
<script type="text/javascript" language="javascript" src="//code.jquery.com/jquery-1.11.1.min.js"></script><br />
<script type="text/javascript" language="javascript" src="//cdn.datatables.net/1.10.4/js/jquery.dataTables.min.js"></script>
<link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.4/css/jquery.dataTables.css">
<script language="javascript">
$('#myDataTable').dataTable( {
        processing: true,
        serverSide: true,
        ajax: {
            "url": "/index.php/DataTableExample/dataTable",
            "type": "POST"
        },
        columns: [
            { data: "s.s_name" },
            {data : "c.c_name"},
            {data : "c.c_zip"},
            { data: "$.city_state_zip" } //refers to the expression in the "More Advanced DatatableModel Implementation"
        ]
    });
</script>