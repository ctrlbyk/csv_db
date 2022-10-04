# De CSV a MySQL
Insertar registros a una base de datos a partir de un archivo CSV, especificando el número de columna a extraer del CSV y el nombre, en el archivo **fields.php**

### to_db
Insertar directamente en la base de datos. Se debe especificar datos propios de la conexión. (username, password, database)

### to_sql
Genera un **script.sql** para posteriormente insertar en la base de datos. 
