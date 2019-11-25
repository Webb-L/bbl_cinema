# BBL电影院售票系统安装

1. 创建数据库

2. 打开根目录**.env**文件，把**DB_DATABASE=bbl**中的**bbl**替换为你创建的数据库名称，把**DB_USERNAME=root**中的**root**替换为数据库用户名，把**DB_PASSWORD=root**中的**root**替换为数据库密码。**注意：**一定要保证数据库信息正确，如果不正确下面的步骤不会成功！

3. 在项目根目录**命令行工具**执行**php artisan migrate:install **成功会如下所示。（请先配置好PHP环境变量再执行）

   ````bash
   $ php migrate:install
   Migration table created successfully.
   ````

4. 然后执行**php artisan migrate**创建数据表,成功会如下所示。(如果上面步骤报错,这条命令不会有效果)

5. ````bash
   $ php artisan migrate
   Migrating: 2014_10_12_000000_create_users_table
   Migrated:  2014_10_12_000000_create_users_table
   Migrating: 2019_11_18_010816_create_vote_table
   Migrated:  2019_11_18_010816_create_vote_table
   Migrating: 2019_11_19_020629_create_purchase_table
   Migrated:  2019_11_19_020629_create_purchase_table
   Migrating: 2019_11_19_070217_create_movie_table
   Migrated:  2019_11_19_070217_create_movie_table
   ````

6. 最后执行**php artisan db:seed**填充数据,成功会如下所示。(如果失败的手动添加数据)

 ````bash
   $ php artisan db:seed 
   Seeding: VoteTableSeeder
   Seeding: MovieTableSeeder
 ````
