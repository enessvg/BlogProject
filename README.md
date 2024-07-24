<h1>FilamentPHP kullanılarak blog sitesi projenin kurulumu:</h1>

blog-api klasörüne girin <br>
<code>docker-compose up -d -build</code> <br>
komudunu çalıştırın.

env dosyası için <br> <code>copy .env.example .env</code> <br> komutunu çalıştırın. Mail işlemleri içinde mail ayarlarınızı yapmayı unutmayın.

Proje ayağa kalktığı zaman filamentphp için admin kullanıcısı oluşturmak için <br>
<code> php artisan make:filament-user </code>
komudunu kullanın. <br>
<code> php artisan shield:install </code> komudunu kullanın. <br>

FilamentPHP'ye giriş yapın ve super_admin rolüne sahipsiniz. Projenin backend kısmına erişmiş oldunuz.

Resimler için <code>php artisan storage:link</code> kodunu yazın.

kvkk ve gizlilik politikası yeni ekleme kapalı olduğundan lütfen sırasıyla <br>
<code>php artisan db:seed --class=Kvkk </code> <br>
<code>php artisan db:seed --class=Privacy</code> <br>
komutlarını kullanın.

<hr>
<h1>Blog Sitesinin frontend kısmı için </h1><br>

blog-frontend dosyasına girin (<code>cd blog-frontend</code>) <br>
<code>docker-compose up -d --build </code> kodunu kullanarak dockeri kurun. <br>
eğer ki dockerde projeniz açılmazsa <code> composer install </code> komutunu kullanın.
tekrardan <code>docker-compose up -d --build </code> komudunu kullanın.

localhost:8182 portunda projeyi açabilirsiniz.

