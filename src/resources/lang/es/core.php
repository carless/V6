<?php
return [

    /*
    |--------------------------------------------------------------------------
    | Cesi\Core Language Lines
    |--------------------------------------------------------------------------
    */
    'notifications'          => 'Avisos',
    'messages'               => 'Mensajes',
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
        'name_singular'   => 'Pag.Inicio',
        'name_plural'     => 'Pags.Inicio',
        'select' => '- Seleccionar -',
        'readmore'  => 'Más detalles',
        'user'  => [
            'profile'   => 'Profile',
            'logout'    => 'Desconectar'
        ],
        'fields' => [
            'id'    => 'Id',
            'name'  => 'Nombre',
        ]
    ],
    'dashboarditems'     => [
        'name_singular'   => 'Item Pag.Inicio',
        'name_plural'     => 'Items Pags.Inicio',
        'fields' => [
            'id'        => 'Id',
            'name'      => 'Nombre',
            'dashboard' => 'Pag.Inicio',
            'orden'     => 'Orden',
            'move'      => 'Orden',
            'area'      => 'Area',
            'tipo'      => 'Tipo',
            'titulo'    => 'Titulo',
            'link'      => 'Enlaçe',
            'icono'     => 'Icono',
            'classe'    => 'classe',
            'sql'       => 'Consulta SQL'
        ]
    ],

    'roles' => [
        'fields' => [
            'name'          => 'Nombre',
            'guard_type'    => 'Guard',
        ]
    ],
    'users' => [
        'name_singular'   => 'Usuario',
        'name_plural'     => 'Usuarios',
        'select' => '- Seleccionar -',
        'fields' => [
            'name'      => 'Nombre Usuario',
            'email'     => 'Email',
            ],
        'tabs' => [
            'signature' => 'Firma',
        ],
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
        'send'                      => 'Enviar',
        'print'                     => 'Imprimir',
        'upload'                    => 'Subir',
        'select_file'               => 'Seleccionar archivo',

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

    'taskstatus' => [
        'name_singular'   => 'Tipo Tarea',
        'name_plural'     => 'Tipos de Tareas',
        'select' => '- Seleccionar -',
        'fields' => [
            'name'      => 'Nombre',
            'classname' => 'Clase',
        ],
    ],

    'task' => [
        'name_singular'   => 'Tarea',
        'name_plural'     => 'Tareas',
        'select' => '- Seleccionar -',
        'fields' => [
            'name'          => 'Nombre',
            'status'        => 'Estado',
            'description'   => 'Descripción',
            'asigned_user'  => 'Asignado',
            'statusname'    => 'Estado',
            'prioridad'     => 'Prioridad',
            'fecha_inicio'  => 'F.Inicio',
            'fecha_final'   => 'F.final',
            'progreso'      => 'Progreso',
        ],
        'filters' => [
            'prioridad'     => 'Prioridad',
            'prioridad_select' => 'Seleccionar prioridad',
            'status'        => 'Estado',
            'asigned_user'  => 'Usuario Asignado',
        ],
    ],
    'mytask' => [
        'name_singular'   => 'Mi Tarea',
        'name_plural'     => 'Mis Tareas',
        'pendientes'      => 'Tareas pendientes',
    ],
    'emailtmpl' => [
        'name_singular'   => 'Plantilla Email',
        'name_plural'     => 'Plantillas de Email',
        'actions'   => [
            'sendtest' => 'Test envio',
        ],
        'fields' => [
            'name'          => 'Nombre',
            'slug'          => 'Alias',
            'theme'         => 'Tema',
            'from'          => 'De',
            'from_email'    => 'From (email)',
            'from_name'     => 'From (nombre)',
            'cc_email'      => 'CC',
            'subject'       => 'Asunto',
            'content'       => 'Mensaje',
            ],
    ],

    'preimpresos' => [
        'name_singular'   => 'Pre-Impreso',
        'name_plural'     => 'Pre-Impresos',
        'select' => '- Seleccionar -',
        'tabs'  => [
            'ajustes'   => 'Ajustes',
        ],
        'fields' => [
            'name'          => 'Nombre',
            'slug'          => 'Alias',
            'tipo'          => 'Tipo',
            'papel'         => 'Papel',
            'orientacion'   => 'Orien.',
            'status'        => 'Estado',
            'activo'        => 'Activo',
            'margenCab'     => 'Margen Cabecera',
            'margenPie'     => 'Margen Pie',
            'margenIzq'     => 'Margen Izquierdo',
            'margenDer'     => 'Margen Derecho',
            'mostrarCab'    => 'Mostrar Cabecera',
            'show'          => 'Mostrar',
            'mostrarLogo'   => 'Mostrar Logo',
            'logoPosX'      => 'Logo (Pos X)',
            'logoPosY'      => 'Logo (Pos Y)',
            'mostrarTitulo' => 'Mostrar Título',
            'mostrarSubtitulo' => 'Mostrar subtítulo',
            'tituloPosX'    => 'Titulo (Pos X)',
            'tituloPosY'    => 'Titulo (Pos Y)',
            'mostrarPie'    => 'Mostrar pie',
            'pieSeparador'  => 'Mostrar sep. horizontal',
            'pieFecha'      => 'Mostrar Fecha',
            'pieHora'       => 'Mostrar Hora',
            'pieNumPag'     => 'Mostrar Num.Pag.',
            'pieNumParte'   => 'Mostrar Num.Pdf',
            'archivo'       => 'Archivo PDF',
        ],
        'textos' => [
            'margenes'      => 'Indique los márgenes en milímetros (superior, inferior, izquiero y derecho), ' .
                                'para que el programa no escriba encima de sus textos o imágenes preimpresas ' .
                                'en el documento final. Para que el programa use los márgenes automáticos ' .
                                'deje todos los valores a cero.',
            'showcab'       =>  "Indique si quiere se muestren o no los objetos y textos que el programa " .
                                "genera automáticamente en un listado (logo organización / empresa, título y " .
                                "subtítulo del listado)",
            'showlogo'      =>  "Si quiere mostrar el logo automático del programa, puede forzar una posición " .
                                "con sus coordenadas en milímetros (x,y), donde (0,0) es el vértice superior " .
                                "izquierdo. Si deja los valores a cero el programa mostrará el logo arriba a " .
                                "la izquierda.",
            'showtitulo'    =>  "Si quiere mostrar el título/subtítulo automático del programa, puede forzar " .
                                "una posición con sus coordenadas en milímetros (x,y), donde (0,0) es el " .
                                "vértice superior izquierdo. Si deja los valores a cero el programa mostrará " .
                                "los títulos arriba a la derecha del logo.",
            'showpie'       =>  "Indique si quiere se muestren o no los objetos y textos que el programa " .
                                "genera automáticamente en un listado (pie con fecha/hora impresión y números " .
                                "de página)"
        ],
        'validations' => [
            'name_required' => 'El campo es imprescindible. No se puede dejar vacio.',
            'name_max'      => 'El campo Nombre puede tener un máx de 255 caracteres.',
        ],
    ],
];
