<?php
return [

    /*
    |--------------------------------------------------------------------------
    | Cesi\Core Language Lines
    |--------------------------------------------------------------------------
    */

    'registration_closed'    => 'El registro de usuarios está cerrado.',
    'first_page_you_see'     => 'La página que ves después de iniciar sesión',
    'login_status'           => 'Estado de la conexión',
    'logged_in'              => '¡Usted ha iniciado sesión!',
    'toggle_navigation'      => 'Activar/desactivar la navegación',
    'administration'         => 'ADMINISTRACIÓN',
    'user'                   => 'USUARIO',
    'logout'                 => 'Salir',
    'sign_in'                => 'Login',
    'login'                  => 'Iniciar sesión',
    'register'               => 'Crear usuario',
    'name'                   => 'Nombre',
    'email_address'          => 'Correo',
    'password'               => 'Contraseña',
    'old_password'           => 'Contraseña anterior',
    'new_password'           => 'Contraseña nueva',
    'confirm_password'       => 'Confirmar contraseña',
    'remember_me'            => 'Recordar contraseña',
    'forgot_your_password'   => '¿Olvidó su contraseña?',
    'reset_password'         => 'Restaurar contraseña',
    'send_reset_link'        => 'Enviar enlace para restaurar la contraseña',
    'click_here_to_reset'    => 'Click aquí para restaurar la contraseña',
    'change_password'        => 'Cambiar contraseña',
    'unauthorized'           => 'No autorizado.',
    'handcrafted_by'         => 'Realizado por',
    'powered_by'             => 'Creado con',
    'my_account'             => 'Mi cuenta',
    'update_account_info'    => 'Actualizar información de cuenta',
    'save'                   => 'Guardar',
    'cancel'                 => 'Cancelar',
    'error'                  => 'Error',
    'success'                => 'Existoso',
    'old_password_incorrect' => 'Contraseña antigua incorrecta.',
    'password_dont_match'    => 'Las contraseñas no coinciden.',
    'password_empty'         => 'Asegúrese de que ambos campos de contraseña estén completos.',
    'password_updated'       => 'Contraseña actalizada.',
    'account_updated'        => 'Cuenta actualizada correctamente.',
    'unknown_error'          => 'Ha ocurrido un error. Por favor vuelva a intenter.',
    'error_saving'           => 'Error mientras se guardaba. Por favor vuelva a intenter.',

    'insert_data_success'   => '¡Los datos han sido añadidos!',
    'insert_data_failed'    => '¡Algo ha fallado al grabar los datos!',
    'update_data_success'   => '¡Los datos han sido actualizados con éxito!',
    'update_data_failed'    => 'Algo ha fallado al actualizar los datos',
    'delete_data_success'   => '¡Se ha borrado el registro con éxito!',
    'delete_data_failed'    => 'Algo ha fallado al borrar los datos',

    // Delete
    'delete_title_confirm'  => 'Estás Seguro?',
    'delete_selected'       => '¿Seguro que quieres eliminar el elemento seleccionado?',
    'delete_n_selected_1'   => '¿Seguro que quieres eliminar los',
    'delete_n_selected_2'   => ' elementos seleccionados?',

    // confirmation
    'confirmation_yes'      => '¡Sí!',
    'confirmation_no'       => 'No',

    'dashboard'     => [
        'title' => 'Panel principal',
        'user'  => [
            'profile'   => 'Profile',
            'logout'    => 'Desconectar'
        ]
    ],

    'roles' => [
        'fields' => [
            'name'          => 'Nombre',
            'guard_type'    => 'Guard',
        ]
    ],
    'crud' => [
        'unauthorized_access' => 'Acceso denegado - usted no tiene los permisos necesarios para ver esta página.',
        'please_fix' => 'Por favor corrija los siguientes errores:',

        // Ajax errors
        'ajax_error_title' => 'Error',
        'ajax_error_text'  => 'Error al cargar la página. Por favor actualiza la página.',

        // CRUD table view
        'all'                       => 'Todos los registros de ',
        'in_the_database'           => 'en la base de datos',
        'list'                      => 'Listar',
        'actions'                   => 'Acciones',
        'preview'                   => 'Vista previa',
        'delete'                    => 'Eliminar',
        'admin'                     => 'Admin',
        'new'                       => 'Nuevo',
        'edit'                      => 'Modificar',
        'search'                    => 'Buscar',
        'search_placeholder'        => 'Buscar',
        'cancel'                    => 'Cancelar',
        'save'                      => 'Guardar',

        'details_row'               => 'Esta es la fila de detalles. Modificar a su gusto.',
        'details_row_loading_error' => 'Se ha producido un error al cargar los datos. Por favor, intente de nuevo.',

        'datatables' => [
            'Processing'    => 'Procesando...',
            'LengthMenu'    => 'Mostrar _MENU_ registros',
            'ZeroRecords'   => 'No se encontraron resultados',
            'EmptyTable'    => 'Ningún dato disponible en esta tabla.',
            'Info'          => 'Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros',
            'InfoEmpty'     => 'Mostrando registros del 0 al 0 de un total de 0 registros',
            'InfoFiltered'  => '(filtrado de un total de _MAX_ registros)',
            'InfoPostFix'   => "",
            'Search'        => 'Buscar:',
            'Url'           => "",
            'InfoThousands' => ",",
            'LoadingRecords'=> "Cargando...",
            'Paginate'      => [
                'First'     => 'Primero',
                'Last'      => 'Último',
                'Next'      => 'Siguiente',
                'Previous'  => 'Anterior',
                ],
            'Aria'  => [
                'SortAscending' => ': Activar para ordenar la columna de manera ascendente',
                'SortDescending'=> ': Activar para ordenar la columna de manera descendente'
                ],
            'buttons'   => [
                'copy'  => 'Copiar',
                'colvis'=> 'Visibilidad',
                ],
            ],

        'fields' => [
            'ID'    => 'Id',
            'created_at'    => 'Creado el',
            'updated_at'    => 'Modificado el',
            'created_by'    => 'Creado por',
            'updated_by'    => 'Modificado por',
        ]
    ],

    'permissionmanager' => [
        'name'                  => 'Nombre',
        'role'                  => 'Rol',
        'roles'                 => 'Roles',
        'roles_have_permission' => 'Roles con este permiso',
        'permission_singular'   => 'Permiso',
        'permission_plural'     => 'Permisos',
        'user_singular'         => 'Usuario',
        'user_plural'           => 'Usuarios',
        'email'                 => 'Correo electrónico',
        'extra_permissions'     => 'Permisos adicionales',
        'password'              => 'Contraseña',
        'password_confirmation' => 'Confirmación de contraseña',
        'user_role_permission'  => 'Permisos del rol del usuario',
        'user'                  => 'Usuario',
        'users'                 => 'Usuarios',
        'guard_type'            => 'Guard Type',
        'permission_assigned'   => 'Permisos assignados',
        'roles_assigned'        => 'Roles',
        'fields_user' => [
            'name'      => 'Nombre Usuario',
            'email'     => 'Email',
            'password'  => 'Contraseña',
            'status'    => 'Estado',
            'confirmpassword' => 'Confirmar contraseña',
        ],
        'validations' => [
            'required'          => 'El campo es imprescindible. No se puede dejar vacio.',
            'name_min'          => 'El campo Nombre puede tener un minimo de 3 caracteres.',
            'name_max'          => 'El campo Nombre puede tener un máx de 255 caracteres.',
            'email'             => 'El campo debe ser una dirección de correo válida.',
            'unique'            => 'Ya existe un registro con este código',
        ]
    ],

    'menus' => [
        'name_singular'   => 'Menu',
        'name_plural'     => 'Menus',
        'select' => '- Seleccionar -',
        'fields' => [
            'id'    => 'Id',
            'name'  => 'Nombre',
            'icon'  => 'Icono',
            'type'  => 'Tipo',
            'link'  => 'Link',
            'level' => 'Nivel',
            'lft'   => 'lft',
            'rgt'   => 'rgt',
            'move'  => 'move',
            'parent_id'   => 'Parent',
        ],
    ],
];