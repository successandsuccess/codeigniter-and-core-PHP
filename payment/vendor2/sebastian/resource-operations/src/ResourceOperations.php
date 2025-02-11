<?php
/*
 * This file is part of resource-operations.
 *
 * (c) Sebastian Bergmann <sebastian@phpunit.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace SebastianBergmann\ResourceOperations;

class ResourceOperations
{
    /**
     * @return string[]
     */
    public static function getFunctions()
    {
        return [
            'Directory::close',
            'Directory::read',
            'Directory::rewind',
            'HttpResponse::getRequestBodyStream',
            'HttpResponse::getStream',
            'MongoGridFSCursor::__construct',
            'MongoGridFSFile::getResource',
            'MysqlndUhConnection::stmtInit',
            'MysqlndUhConnection::storeResult',
            'MysqlndUhConnection::useResult',
            'PDF_new',
            'PDO::pgsqlLOBOpen',
            'RarEntry::getStream',
            'SQLite3::openBlob',
            'XMLWriter::openMemory',
            'XMLWriter::openURI',
            'ZipArchive::getStream',
            'bbcode_create',
            'bzopen',
            'crack_opendict',
            'cubrid_connect',
            'cubrid_connect_with_url',
            'cubrid_get_query_timeout',
            'cubrid_lob2_bind',
            'cubrid_lob2_close',
            'cubrid_lob2_export',
            'cubrid_lob2_import',
            'cubrid_lob2_new',
            'cubrid_lob2_read',
            'cubrid_lob2_seek',
            'cubrid_lob2_seek64',
            'cubrid_lob2_size',
            'cubrid_lob2_size64',
            'cubrid_lob2_tell',
            'cubrid_lob2_tell64',
            'cubrid_lob2_write',
            'cubrid_pconnect',
            'cubrid_pconnect_with_url',
            'cubrid_prepare',
            'cubrid_query',
            'cubrid_set_query_timeout',
            'cubrid_unbuffered_query',
            'curl_copy_handle',
            'curl_getinfo',
            'curl_init',
            'curl_multi_add_handle',
            'curl_multi_close',
            'curl_multi_exec',
            'curl_multi_getcontent',
            'curl_multi_info_read',
            'curl_multi_init',
            'curl_multi_remove_handle',
            'curl_multi_select',
            'curl_multi_setopt',
            'curl_pause',
            'curl_reset',
            'curl_setopt',
            'curl_setopt_array',
            'curl_share_close',
            'curl_share_init',
            'curl_share_setopt',
            'curl_unescape',
            'cyrus_connect',
            'db2_column_privileges',
            'db2_columns',
            'db2_connect',
            'db2_exec',
            'db2_foreign_keys',
            'db2_next_result',
            'db2_pconnect',
            'db2_prepare',
            'db2_primary_keys',
            'db2_procedure_columns',
            'db2_procedures',
            'db2_special_columns',
            'db2_statistics',
            'db2_table_privileges',
            'db2_tables',
            'dba_fetch',
            'dba_fetch 1',
            'dba_open',
            'dba_popen',
            'dbplus_aql',
            'dbplus_open',
            'dbplus_rcreate',
            'dbplus_ropen',
            'dbplus_rquery',
            'dbplus_sql',
            'deflate_init',
            'dio_open',
            'eio_busy',
            'eio_cancel',
            'eio_chmod',
            'eio_chown',
            'eio_close',
            'eio_custom',
            'eio_dup2',
            'eio_fallocate',
            'eio_fchmod',
            'eio_fchown',
            'eio_fdatasync',
            'eio_fstat',
            'eio_fstatvfs',
            'eio_fsync',
            'eio_ftruncate',
            'eio_futime',
            'eio_get_last_error',
            'eio_grp',
            'eio_grp_add',
            'eio_grp_cancel',
            'eio_grp_limit',
            'eio_link',
            'eio_lstat',
            'eio_mkdir',
            'eio_mknod',
            'eio_nop',
            'eio_open',
            'eio_read',
            'eio_readahead',
            'eio_readdir',
            'eio_readlink',
            'eio_realpath',
            'eio_rename',
            'eio_rmdir',
            'eio_seek',
            'eio_sendfile',
            'eio_stat',
            'eio_statvfs',
            'eio_symlink',
            'eio_sync',
            'eio_sync_file_range',
            'eio_syncfs',
            'eio_truncate',
            'eio_unlink',
            'eio_utime',
            'eio_write',
            'enchant_broker_free_dict',
            'enchant_broker_init',
            'enchant_broker_request_dict',
            'enchant_broker_request_pwl_dict',
            'event_base_new',
            'event_base_reinit',
            'event_buffer_new',
            'event_new',
            'event_priority_set',
            'event_timer_set',
            'expect_popen',
            'fam_monitor_collection',
            'fam_monitor_directory',
            'fam_monitor_file',
            'fam_open',
            'fann_cascadetrain_on_data',
            'fann_cascadetrain_on_file',
            'fann_clear_scaling_params',
            'fann_copy',
            'fann_create_from_file',
            'fann_create_shortcut_array',
            'fann_create_standard',
            'fann_create_standard_array',
            'fann_create_train',
            'fann_create_train_from_callback',
            'fann_descale_input',
            'fann_descale_output',
            'fann_descale_train',
            'fann_destroy',
            'fann_destroy_train',
            'fann_duplicate_train_data',
            'fann_get_MSE',
            'fann_get_activation_function',
            'fann_get_activation_steepness',
            'fann_get_bias_array',
            'fann_get_bit_fail',
            'fann_get_bit_fail_limit',
            'fann_get_cascade_activation_functions',
            'fann_get_cascade_activation_functions_count',
            'fann_get_cascade_activation_steepnesses',
            'fann_get_cascade_activation_steepnesses_count',
            'fann_get_cascade_candidate_change_fraction',
            'fann_get_cascade_candidate_limit',
            'fann_get_cascade_candidate_stagnation_epochs',
            'fann_get_cascade_max_cand_epochs',
            'fann_get_cascade_max_out_epochs',
            'fann_get_cascade_min_cand_epochs',
            'fann_get_cascade_min_out_epochs',
            'fann_get_cascade_num_candidate_groups',
            'fann_get_cascade_num_candidates',
            'fann_get_cascade_output_change_fraction',
            'fann_get_cascade_output_stagnation_epochs',
            'fann_get_cascade_weight_multiplier',
            'fann_get_connection_array',
            'fann_get_connection_rate',
            'fann_get_errno',
            'fann_get_errstr',
            'fann_get_layer_array',
            'fann_get_learning_momentum',
            'fann_get_learning_rate',
            'fann_get_network_type',
            'fann_get_num_input',
            'fann_get_num_layers',
            'fann_get_num_output',
            'fann_get_quickprop_decay',
            'fann_get_quickprop_mu',
            'fann_get_rprop_decrease_factor',
            'fann_get_rprop_delta_max',
            'fann_get_rprop_delta_min',
            'fann_get_rprop_delta_zero',
            'fann_get_rprop_increase_factor',
            'fann_get_sarprop_step_error_shift',
            'fann_get_sarprop_step_error_threshold_factor',
            'fann_get_sarprop_temperature',
            'fann_get_sarprop_weight_decay_shift',
            'fann_get_total_connections',
            'fann_get_total_neurons',
            'fann_get_train_error_function',
            'fann_get_train_stop_function',
            'fann_get_training_algorithm',
            'fann_init_weights',
            'fann_length_train_data',
            'fann_merge_train_data',
            'fann_num_input_train_data',
            'fann_num_output_train_data',
            'fann_randomize_weights',
            'fann_read_train_from_file',
            'fann_reset_errno',
            'fann_reset_errstr',
            'fann_run',
            'fann_save',
            'fann_save_train',
            'fann_scale_input',
            'fann_scale_input_train_data',
            'fann_scale_output',
            'fann_scale_output_train_data',
            'fann_scale_train',
            'fann_scale_train_data',
            'fann_set_activation_function',
            'fann_set_activation_function_hidden',
            'fann_set_activation_function_layer',
            'fann_set_activation_function_output',
            'fann_set_activation_steepness',
            'fann_set_activation_steepness_hidden',
            'fann_set_activation_steepness_layer',
            'fann_set_activation_steepness_output',
            'fann_set_bit_fail_limit',
            'fann_set_callback',
            'fann_set_cascade_activation_functions',
            'fann_set_cascade_activation_steepnesses',
            'fann_set_cascade_candidate_change_fraction',
            'fann_set_cascade_candidate_limit',
            'fann_set_cascade_candidate_stagnation_epochs',
            'fann_set_cascade_max_cand_epochs',
            'fann_set_cascade_max_out_epochs',
            'fann_set_cascade_min_cand_epochs',
            'fann_set_cascade_min_out_epochs',
            'fann_set_cascade_num_candidate_groups',
            'fann_set_cascade_output_change_fraction',
            'fann_set_cascade_output_stagnation_epochs',
            'fann_set_cascade_weight_multiplier',
            'fann_set_error_log',
            'fann_set_input_scaling_params',
            'fann_set_learning_momentum',
            'fann_set_learning_rate',
            'fann_set_output_scaling_params',
            'fann_set_quickprop_decay',
            'fann_set_quickprop_mu',
            'fann_set_rprop_decrease_factor',
            'fann_set_rprop_delta_max',
            'fann_set_rprop_delta_min',
            'fann_set_rprop_delta_zero',
            'fann_set_rprop_increase_factor',
            'fann_set_sarprop_step_error_shift',
            'fann_set_sarprop_step_error_threshold_factor',
            'fann_set_sarprop_temperature',
            'fann_set_sarprop_weight_decay_shift',
            'fann_set_scaling_params',
            'fann_set_train_error_function',
            'fann_set_train_stop_function',
            'fann_set_training_algorithm',
            'fann_set_weight',
            'fann_set_weight_array',
            'fann_shuffle_train_data',
            'fann_subset_train_data',
            'fann_test',
            'fann_test_data',
            'fann_train',
            'fann_train_epoch',
            'fann_train_on_data',
            'fann_train_on_file',
            'fbsql_connect',
            'fbsql_db_query',
            'fbsql_list_dbs',
            'fbsql_list_fields',
            'fbsql_list_tables',
            'fbsql_pconnect',
            'fbsql_query',
            'fdf_create',
            'fdf_open',
            'fdf_open_string',
            'finfo::buffer',
            'finfo_buffer',
            'finfo_close',
            'finfo_file',
            'finfo_open',
            'finfo_set_flags',
            'fopen',
            'fsockopen',
            'ftp_alloc',
            'ftp_cdup',
            'ftp_chdir',
            'ftp_chmod',
            'ftp_close',
            'ftp_connect',
            'ftp_delete',
            'ftp_exec',
            'ftp_fget',
            'ftp_fput',
            'ftp_get',
            'ftp_get_option',
            'ftp_login',
            'ftp_mdtm',
            'ftp_mkdir',
            'ftp_nb_continue',
            'ftp_nb_fget',
            'ftp_nb_fput',
            'ftp_nb_get',
            'ftp_nb_put',
            'ftp_nlist',
            'ftp_pasv',
            'ftp_put',
            'ftp_pwd',
            'ftp_raw',
            'ftp_rawlist',
            'ftp_rename',
            'ftp_rmdir',
            'ftp_set_option',
            'ftp_site',
            'ftp_size',
            'ftp_ssl_connect',
            'ftp_systype',
            'gnupg_init',
            'gupnp_context_new',
            'gupnp_control_point_new',
            'gupnp_device_info_get_service',
            'gupnp_root_device_new',
            'gzopen',
            'hash_copy',
            'hash_final',
            'hash_init',
            'hash_update',
            'hash_update_file',
            'hash_update_stream',
            'http_get_request_body_stream',
            'ibase_blob_create',
            'ibase_blob_open',
            'ibase_blob_open 1',
            'ibase_connect',
            'ibase_pconnect',
            'ibase_prepare',
            'ibase_service_attach',
            'ibase_set_event_handler',
            'ibase_set_event_handler 1',
            'ibase_trans',
            'ifx_connect',
            'ifx_pconnect',
            'ifx_prepare',
            'ifx_query',
            'imageaffine',
            'imageconvolution',
            'imagecreate',
            'imagecreatefromgd',
            'imagecreatefromgd2',
            'imagecreatefromgd2part',
            'imagecreatefromgif',
            'imagecreatefromjpeg',
            'imagecreatefrompng',
            'imagecreatefromstring',
            'imagecreatefromwbmp',
            'imagecreatefromwebp',
            'imagecreatefromxbm',
            'imagecreatefromxpm',
            'imagecreatetruecolor',
            'imagegrabscreen',
            'imagegrabwindow',
            'imagepalettetotruecolor',
            'imagepsloadfont',
            'imagerotate',
            'imagescale',
            'imap_open',
            'inflate_init',
            'ingres_connect',
            'ingres_pconnect',
            'inotify_init',
            'kadm5_init_with_password',
            'ldap_connect',
            'ldap_first_entry',
            'ldap_first_reference',
            'ldap_list',
            'ldap_next_entry',
            'ldap_next_reference',
            'ldap_read',
            'ldap_search',
            'm_initconn',
            'mailparse_msg_create',
            'mailparse_msg_get_part',
            'mailparse_msg_parse_file',
            'maxdb::use_result',
            'maxdb_connect',
            'maxdb_embedded_connect',
            'maxdb_init',
            'maxdb_stmt::result_metadata',
            'maxdb_stmt_result_metadata',
            'maxdb_use_result',
            'mcrypt_module_open',
            'msg_get_queue',
            'msql_connect',
            'msql_db_query',
            'msql_list_dbs',
            'msql_list_fields',
            'msql_list_tables',
            'msql_pconnect',
            'msql_query',
            'mssql_connect',
            'mssql_init',
            'mssql_pconnect',
            'mysql_connect',
            'mysql_db_query',
            'mysql_list_dbs',
            'mysql_list_fields',
            'mysql_list_processes',
            'mysql_list_tables',
            'mysql_pconnect',
            'mysql_query',
            'mysql_unbuffered_query',
            'mysqlnd_uh_convert_to_mysqlnd',
            'ncurses_new_panel',
            'ncurses_newpad',
            'ncurses_newwin',
            'ncurses_panel_above',
            'ncurses_panel_below',
            'ncurses_panel_window',
            'newt_button',
            'newt_button_bar',
            'newt_checkbox',
            'newt_checkbox_tree',
            'newt_checkbox_tree_multi',
            'newt_compact_button',
            'newt_create_grid',
            'newt_entry',
            'newt_form',
            'newt_form_get_current',
            'newt_grid_basic_window',
            'newt_grid_h_close_stacked',
            'newt_grid_h_stacked',
            'newt_grid_simple_window',
            'newt_grid_v_close_stacked',
            'newt_grid_v_stacked',
            'newt_label',
            'newt_listbox',
            'newt_listitem',
            'newt_radio_get_current',
            'newt_radiobutton',
            'newt_run_form',
            'newt_scale',
            'newt_textbox',
            'newt_textbox_reflowed',
            'newt_vertical_scrollbar',
            'oci_connect',
            'oci_get_implicit_resultset',
            'oci_new_connect',
            'oci_new_cursor',
            'oci_parse',
            'oci_pconnect',
            'odbc_columnprivileges',
            'odbc_columns',
            'odbc_connect',
            'odbc_exec',
            'odbc_foreignkeys',
            'odbc_gettypeinfo',
            'odbc_pconnect',
            'odbc_prepare',
            'odbc_primarykeys',
            'odbc_procedurecolumns',
            'odbc_procedures',
            'odbc_specialcolumns',
            'odbc_statistics',
            'odbc_tableprivileges',
            'odbc_tables',
            'openal_buffer_create',
            'openal_context_create',
            'openal_device_open',
            'openal_source_create',
            'openal_stream',
            'openssl_csr_new',
            'openssl_csr_sign',
            'openssl_pkey_get_private',
            'openssl_pkey_get_public',
            'openssl_pkey_new',
            'openssl_x509_read',
            'pfsockopen',
            'pg_cancel_query',
            'pg_client_encoding',
            'pg_close',
            'pg_connect',
            'pg_connect_poll',
            'pg_connection_busy',
            'pg_connection_reset',
            'pg_connection_status',
            'pg_consume_input',
            'pg_copy_from',
            'pg_copy_to',
            'pg_dbname',
            'pg_end_copy',
            'pg_escape_bytea',
            'pg_escape_identifier',
            'pg_escape_identifier 1',
            'pg_escape_literal',
            'pg_escape_string',
            'pg_execute',
            'pg_execute 1',
            'pg_flush',
            'pg_free_result',
            'pg_get_notify',
            'pg_get_pid',
            'pg_get_result',
            'pg_host',
            'pg_last_error',
            'pg_last_notice',
            'pg_lo_create',
            'pg_lo_export',
            'pg_lo_import',
            'pg_lo_open',
            'pg_lo_unlink',
            'pg_options',
            'pg_parameter_status',
            'pg_pconnect',
            'pg_ping',
            'pg_port',
            'pg_prepare',
            'pg_prepare 1',
            'pg_put_line',
            'pg_query',
            'pg_query 1',
            'pg_query_params',
            'pg_query_params 1',
            'pg_send_execute',
            'pg_send_prepare',
            'pg_send_query',
            'pg_send_query_params',
            'pg_set_client_encoding',
            'pg_set_client_encoding 1',
            'pg_set_error_verbosity',
            'pg_socket',
            'pg_trace',
            'pg_transaction_status',
            'pg_tty',
            'pg_untrace',
            'pg_version',
            'php_user_filter::filter',
            'popen',
            'proc_open',
            'ps_new',
            'px_new',
            'radius_acct_open',
            'radius_auth_open',
            'radius_salt_encrypt_attr',
            'rpm_open',
            'sem_get',
            'shm_attach',
            'socket_accept',
            'socket_create',
            'socket_create_listen',
            'socket_recvmsg',
            'socket_sendmsg',
            'sqlite_open',
            'sqlite_popen',
            'sqlsrv_begin_transaction',
            'sqlsrv_cancel',
            'sqlsrv_client_info',
            'sqlsrv_close',
            'sqlsrv_commit',
            'sqlsrv_connect',
            'sqlsrv_execute',
            'sqlsrv_fetch',
            'sqlsrv_fetch_array',
            'sqlsrv_fetch_object',
            'sqlsrv_field_metadata',
            'sqlsrv_free_stmt',
            'sqlsrv_get_field',
            'sqlsrv_has_rows',
            'sqlsrv_next_result',
            'sqlsrv_num_fields',
            'sqlsrv_num_rows',
            'sqlsrv_prepare',
            'sqlsrv_query',
            'sqlsrv_rollback',
            'sqlsrv_rows_affected',
            'sqlsrv_send_stream_data',
            'sqlsrv_server_info',
            'ssh2_auth_agent',
            'ssh2_connect',
            'ssh2_exec',
            'ssh2_fetch_stream',
            'ssh2_publickey_init',
            'ssh2_sftp',
            'ssh2_sftp_chmod',
            'ssh2_shell',
            'ssh2_tunnel',
            'stomp_connect',
            'streamWrapper::stream_cast',
            'stream_bucket_new',
            'stream_context_create',
            'stream_context_get_default',
            'stream_context_set_default',
            'stream_filter_append',
            'stream_filter_prepend',
            'stream_socket_accept',
            'stream_socket_client',
            'stream_socket_server',
            'svn_fs_apply_text',
            'svn_fs_begin_txn2',
            'svn_fs_file_contents',
            'svn_fs_revision_root',
            'svn_fs_txn_root',
            'svn_repos_create',
            'svn_repos_fs',
            'svn_repos_fs_begin_txn_for_commit',
            'svn_repos_open',
            'sybase_connect',
            'sybase_pconnect',
            'sybase_unbuffered_query',
            'tmpfile',
            'udm_alloc_agent',
            'udm_alloc_agent_array',
            'udm_find',
            'unlink',
            'w32api_init_dtype',
            'wddx_packet_start',
            'xml_parser_create',
            'xml_parser_create_ns',
            'xml_parser_free',
            'xml_parser_get_option',
            'xml_parser_set_option',
            'xmlrpc_server_create',
            'xmlwriter_open_memory',
            'xmlwriter_open_uri',
            'xslt_create',
            'zip_open',
            'zip_read',
        ];
    }
}
