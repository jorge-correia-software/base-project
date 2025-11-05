<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Audit Logging Configuration
    |--------------------------------------------------------------------------
    |
    | This file configures the comprehensive audit logging system for both
    | Vaste admin and tenant admin dashboards.
    |
    */

    /**
     * Enable/disable audit logging globally
     */
    'enabled' => env('AUDIT_ENABLED', true),

    /**
     * Enable/disable tenant audit logging
     */
    'tenant_enabled' => env('TENANT_AUDIT_ENABLED', true),

    /*
    |--------------------------------------------------------------------------
    | Vaste Admin Audit Settings
    |--------------------------------------------------------------------------
    */

    /**
     * Log guest/unauthenticated actions in Vaste admin
     */
    'log_guest_actions' => env('AUDIT_LOG_GUEST_ACTIONS', false),

    /**
     * Log request headers in Vaste admin logs
     */
    'log_request_headers' => env('AUDIT_LOG_REQUEST_HEADERS', true),

    /**
     * Log request body in Vaste admin logs
     */
    'log_request_body' => env('AUDIT_LOG_REQUEST_BODY', true),

    /**
     * Paths to skip from Vaste admin audit logging
     */
    'skip_paths' => [
        'health',
        'status',
        'ping',
        '_debugbar',
        'telescope',
        'horizon',
        'livewire',
        'broadcasting',
        'sanctum',
    ],

    /*
    |--------------------------------------------------------------------------
    | Tenant Audit Settings
    |--------------------------------------------------------------------------
    */

    /**
     * Log guest/unauthenticated actions in tenant context
     */
    'tenant_log_guest_actions' => env('TENANT_AUDIT_LOG_GUEST_ACTIONS', false),

    /**
     * Log request headers in tenant audit logs
     */
    'tenant_log_request_headers' => env('TENANT_AUDIT_LOG_REQUEST_HEADERS', false),

    /**
     * Log request body in tenant audit logs
     */
    'tenant_log_request_body' => env('TENANT_AUDIT_LOG_REQUEST_BODY', true),

    /**
     * Paths to skip from tenant audit logging
     */
    'tenant_skip_paths' => [
        'health',
        'status',
        'ping',
        '_debugbar',
        'telescope',
        'horizon',
        'livewire',
        'broadcasting',
        'sanctum',
        'pusher',
    ],

    /*
    |--------------------------------------------------------------------------
    | Sensitive Data Protection
    |--------------------------------------------------------------------------
    */

    /**
     * Headers that should be redacted in logs
     */
    'sensitive_headers' => [
        'authorization',
        'cookie',
        'x-csrf-token',
        'x-api-key',
        'x-api-secret',
        'api-key',
        'api-secret',
    ],

    /**
     * Request fields that should be redacted in logs
     */
    'sensitive_fields' => [
        'password',
        'password_confirmation',
        'current_password',
        'new_password',
        'credit_card',
        'card_number',
        'cvv',
        'cvc',
        'ssn',
        'social_security_number',
        'api_key',
        'api_secret',
        'secret',
        'token',
        'private_key',
        'bank_account',
        'iban',
        'swift',
    ],

    /*
    |--------------------------------------------------------------------------
    | Security Settings
    |--------------------------------------------------------------------------
    */

    /**
     * Maximum failed login attempts before lockout
     */
    'max_failed_logins' => env('AUDIT_MAX_FAILED_LOGINS', 5),

    /**
     * Maximum critical actions in short time before alert
     */
    'max_critical_actions' => env('AUDIT_MAX_CRITICAL_ACTIONS', 10),

    /**
     * Time window for failed login attempts (minutes)
     */
    'failed_login_window' => env('AUDIT_FAILED_LOGIN_WINDOW', 30),

    /**
     * Time window for critical actions (minutes)
     */
    'critical_actions_window' => env('AUDIT_CRITICAL_ACTIONS_WINDOW', 5),

    /*
    |--------------------------------------------------------------------------
    | Retention Settings
    |--------------------------------------------------------------------------
    */

    /**
     * Days to retain Vaste admin audit logs (0 = forever)
     */
    'retention_days' => env('AUDIT_RETENTION_DAYS', 365),

    /**
     * Days to retain tenant audit logs (0 = forever)
     */
    'tenant_retention_days' => env('TENANT_AUDIT_RETENTION_DAYS', 90),

    /**
     * Days to retain critical/alert logs (0 = forever)
     */
    'critical_retention_days' => env('AUDIT_CRITICAL_RETENTION_DAYS', 730), // 2 years

    /**
     * Enable automatic cleanup of old logs
     */
    'auto_cleanup' => env('AUDIT_AUTO_CLEANUP', true),

    /**
     * Time to run daily cleanup (24-hour format)
     */
    'cleanup_time' => env('AUDIT_CLEANUP_TIME', '02:00'),

    /*
    |--------------------------------------------------------------------------
    | Alert Settings
    |--------------------------------------------------------------------------
    */

    /**
     * Send alerts for critical actions
     */
    'alert_on_critical' => env('AUDIT_ALERT_ON_CRITICAL', true),

    /**
     * Email addresses to send alerts to
     */
    'alert_emails' => env('AUDIT_ALERT_EMAILS', ''),

    /**
     * Slack webhook for alerts
     */
    'slack_webhook' => env('AUDIT_SLACK_WEBHOOK'),

    /**
     * Actions that trigger immediate alerts
     */
    'alert_actions' => [
        'tenant_deleted',
        'license_downgraded',
        'mass_data_export',
        'database_reset',
        'admin_permission_changed',
        'security_settings_changed',
        'payment_refunded',
        'subscription_cancelled',
    ],

    /*
    |--------------------------------------------------------------------------
    | Performance Settings
    |--------------------------------------------------------------------------
    */

    /**
     * Queue audit logs for better performance
     */
    'use_queue' => env('AUDIT_USE_QUEUE', false),

    /**
     * Queue name for audit logs
     */
    'queue_name' => env('AUDIT_QUEUE_NAME', 'audit'),

    /**
     * Batch size for bulk operations
     */
    'batch_size' => env('AUDIT_BATCH_SIZE', 100),

    /**
     * Enable audit log caching
     */
    'cache_enabled' => env('AUDIT_CACHE_ENABLED', true),

    /**
     * Cache duration in minutes
     */
    'cache_duration' => env('AUDIT_CACHE_DURATION', 60),

    /*
    |--------------------------------------------------------------------------
    | Export Settings
    |--------------------------------------------------------------------------
    */

    /**
     * Allowed export formats
     */
    'export_formats' => ['csv', 'json', 'pdf', 'excel'],

    /**
     * Maximum records per export
     */
    'export_limit' => env('AUDIT_EXPORT_LIMIT', 10000),

    /**
     * Export storage path
     */
    'export_path' => storage_path('app/audit-exports'),

    /**
     * Days to retain export files
     */
    'export_retention_days' => env('AUDIT_EXPORT_RETENTION_DAYS', 7),

    /*
    |--------------------------------------------------------------------------
    | Database Settings
    |--------------------------------------------------------------------------
    */

    /**
     * Database connection for Vaste audit logs
     */
    'connection' => env('AUDIT_DB_CONNECTION', null),

    /**
     * Database connection for tenant audit logs
     */
    'tenant_connection' => env('TENANT_AUDIT_DB_CONNECTION', null),

    /**
     * Enable database transactions for audit logs
     */
    'use_transactions' => env('AUDIT_USE_TRANSACTIONS', true),

    /*
    |--------------------------------------------------------------------------
    | Model Auditing Settings
    |--------------------------------------------------------------------------
    */

    /**
     * Models that should always be audited
     */
    'always_audit_models' => [
        \App\Models\Tenant::class,
        \App\Models\License::class,
        \App\Models\TenantSubscription::class,
        \App\Models\UserApplication::class,
        \App\Models\UBDomainsAdmin::class,
    ],

    /**
     * Models that should never be audited
     */
    'never_audit_models' => [
        \App\Models\AuditLog::class,
        \App\Models\TenantAuditLog::class,
    ],

    /**
     * Default events to audit for models
     */
    'audit_events' => [
        'created',
        'updated',
        'deleted',
        'restored',
    ],

];