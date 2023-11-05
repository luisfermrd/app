// Inicializar DataTables
const dataTable = new DataTable('#tableGroups', {
    responsive: true,
    language: {
        url: '//cdn.datatables.net/plug-ins/1.13.6/i18n/es-CO.json',
    },
    "aProcessing": true,
    "aServerSide": true,
    ajax: {
        url: '../indexRequest.php',
        method: 'POST',
        dataType: 'json',
        data: {
            controller: 'group',
            action: 'readGroups',
        },
        dataSrc: 'data'
    },
    columns: [
        { title: 'Nombre', data: 'GroupName' },
        { title: 'Descripcion', data: 'Description' },
        {
            title: 'Opciones',
            data: 'GroupID',
            render: function (data, type, row, meta) {
                return `
                        <a class="button" href='./updateGroup.php?id=${data}'>
                            <span>Editar</span>
                            <i class="fa-solid fa-pen-to-square"></i>
                        </a>
                        <a class="button" onclick="deleteGroup(${data})">
                            <span>Eliminar</span>
                            <i class="fa-solid fa-trash-can"></i>
                        </a>`;
            }
        },
    ],
    columnDefs: [
        {
            targets: 2, // Índice de la columna "Opciones"
            className: 'acciones-table' // Agrega la clase CSS a las celdas de la columna "Opciones"
        }
    ],
    "bDestroy": true,
    "iDisplayLength": 5
});

function deleteGroup(id) {
    Swal.fire({
        title: '¿eliminar grupo?',
        text: "¿Seguro? si lo eliminar no podras recuperar sus datos",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si, eliminar!',
        cancelButtonText: 'Cancelar'
    }).then((result) => {
        if (result.isConfirmed) {
            let data = new FormData();
            data.append('controller', 'group');
            data.append('action', 'deleteGroup');
            data.append('groupID', id);
            $.ajax({
                type: "post",
                url: "../indexRequest.php",
                data: data,
                contentType: false,
                processData: false,
                success: function (response) {
                    if (response.status == 'success') {
                        Swal.fire(
                            'Eliminado!',
                            response.message,
                            'success'
                        )
                        // Recarga los datos del DataTable
                        dataTable.ajax.reload();
                    } else {
                        Swal.fire(
                            'Opps!',
                            response.message,
                            'error'
                        )
                    }
                }
            });

        }
    })
}