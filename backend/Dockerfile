FROM yiisoftware/yii2-php:8.4-apache

# Change document root for Apache
RUN sed -i -e 's|/app/web|/app/backend/web|g' /etc/apache2/sites-available/000-default.conf

# Install required system dependencies
RUN apt-get update && apt-get install -y \
    gnupg2 \
    curl \
    ca-certificates \
    apt-transport-https \
    unixodbc \
    unixodbc-dev \
    libssl-dev

# Add Microsoft repository key properly
RUN curl -fsSL https://packages.microsoft.com/keys/microsoft.asc | gpg --dearmor > /usr/share/keyrings/microsoft-prod.gpg \
    && echo "deb [arch=amd64 signed-by=/usr/share/keyrings/microsoft-prod.gpg] https://packages.microsoft.com/debian/12/prod bookworm main" \
    > /etc/apt/sources.list.d/mssql-release.list

# Update and install SQL Server ODBC drivers
RUN apt-get update && ACCEPT_EULA=Y apt-get install -y \
    msodbcsql18 \
    mssql-tools \
    unixodbc-dev

# Install PHP extensions for SQL Server
RUN pecl install sqlsrv pdo_sqlsrv \
    && docker-php-ext-enable sqlsrv pdo_sqlsrv

# Clean up unnecessary files
RUN apt-get clean && rm -rf /var/lib/apt/lists/*