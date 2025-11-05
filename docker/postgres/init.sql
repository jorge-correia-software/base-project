-- Vaste PostgreSQL Initialization Script
-- This script runs when the PostgreSQL container is first created
-- It enables required extensions for Vaste functionality

-- Enable UUID generation (for primary keys)
CREATE EXTENSION IF NOT EXISTS "uuid-ossp";

-- Enable pgcrypto (for encryption, hashing, JWT)
CREATE EXTENSION IF NOT EXISTS "pgcrypto";

-- Enable pg_stat_statements (for query performance monitoring)
CREATE EXTENSION IF NOT EXISTS "pg_stat_statements";

-- Enable pg_trgm (for full-text search and similarity matching)
CREATE EXTENSION IF NOT EXISTS "pg_trgm";

-- Optional: Enable postgis (for geospatial data - uncomment if needed)
-- CREATE EXTENSION IF NOT EXISTS "postgis";

-- Optional: Enable pgvector (for AI/ML vector embeddings - uncomment if needed)
-- CREATE EXTENSION IF NOT EXISTS "vector";

-- Create helper function for RLS (Row-Level Security)
-- This function retrieves the current user ID from session variables
CREATE OR REPLACE FUNCTION current_user_id()
RETURNS UUID AS $$
BEGIN
    RETURN NULLIF(current_setting('app.current_user_id', true), '')::uuid;
EXCEPTION
    WHEN OTHERS THEN
        RETURN NULL;
END;
$$ LANGUAGE plpgsql STABLE;

-- Create helper function to get current project ref
CREATE OR REPLACE FUNCTION current_project_ref()
RETURNS TEXT AS $$
BEGIN
    RETURN NULLIF(current_setting('app.current_project_ref', true), '');
EXCEPTION
    WHEN OTHERS THEN
        RETURN NULL;
END;
$$ LANGUAGE plpgsql STABLE;

-- Grant usage on schema
GRANT USAGE ON SCHEMA public TO PUBLIC;
GRANT ALL ON SCHEMA public TO PUBLIC;

-- Log successful initialization
DO $$
BEGIN
    RAISE NOTICE 'Vaste PostgreSQL extensions initialized successfully';
    RAISE NOTICE 'Enabled extensions: uuid-ossp, pgcrypto, pg_stat_statements, pg_trgm';
    RAISE NOTICE 'Created helper functions: current_user_id(), current_project_ref()';
END $$;
