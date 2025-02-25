IF NOT EXISTS (SELECT * FROM sys.sql_logins WHERE name = 'newuser')
BEGIN
    CREATE LOGIN newuser WITH PASSWORD = 'password123!', CHECK_POLICY = OFF;
    ALTER SERVER ROLE sysadmin ADD MEMBER 'newuser';
END
GO

-- Create the database if it doesn't exist
IF NOT EXISTS (SELECT * FROM sys.databases WHERE name = 'master')
BEGIN
    CREATE DATABASE master;
END
GO

-- Switch to the new database
USE master;
GO