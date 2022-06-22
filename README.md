# FitMe

http://fitme.ddns.net/

Una página web que permitira llevar una cuenta de las calorias consumidas diariamente,y además, registrar los entrenamientos, guardar los ejercicios realizados, el peso , número de repeticiones, etc.

En la aplicación se incluirán recetas predefinidas que el usuario administrador podra modificar/eliminar o añadir, y además, se permitira que cada usuario pueda crear sus propias recetas para poder guardar sus comidas más fácilmente.

Se utilizara laravel para realizar el backend, en el frontend se utilizara vue.js, html y css, y en la base de datos MySQL.

La página se encontrará disponible tanto en español como en inglés, y el usuario podrá elegir fácilmente entre ambos idiomas.

<h1>Roles</h1>

La web diferenciara entre tres tipos de usuarios y cada uno podra ver lo siguiente:
<ul>

<li>Los usuarios no logueados podrán ver una página principal en la que se mostrará información de como funciona la web, además de la pantalla de registro y login</li>
	
<li>Los usuarios registrados podrán ver su diario de entrenamientos y calorias, y podrán añadir, editar o eliminar cualquiera de estos. Además podrán visualizar su      progreso</li>

<li>Los usuarios administradores podrán ver todos los alimentos y ejercicios que hay disponibles y eliminarlos/editarlos o añadir mas</li></ul>

<h1>Diseño</h1>

Este es el diseño provisional a modo de boceto de algunas de las principales páginas de la aplicación.

<h3>Landing Page</h3>

![image](https://user-images.githubusercontent.com/71279176/160838067-9e4c07e7-1713-4399-8267-93164ef99d5a.png)

<h3>Diario de comidas</h3>

![image](https://user-images.githubusercontent.com/71279176/160838191-bd4807dd-9d18-4476-b8bb-04591df21d75.png)

<h1>Diagrama E/R</h1>

![image](https://user-images.githubusercontent.com/71279176/160837432-c471aa9a-5365-4a7c-82bc-facee322265d.png)

<h1>Despliegue de la aplicación</h1>

Para desplegar la aplicación se utilizara Amazon Web Services, alojando la aplicación y la base de datos en dos máquinas diferentes. 

El dominio será uno gratuito o .es

<h1>Bibliografía</h1>

<ul>
    <li><a href="https://laravel.com/docs/9.x/">Laravel</a></li>
    <li><a href="https://vuejs.org/guide/introduction.html">Vue.js</a></li>
    <li><a href="https://www.php.net/docs.php">PHP</a></li>
</ul>
 
<h1>Tutorial de uso</h1>

Al entrar por pirmera vez a la aplicación se podra ver la landing page desde la cual el usuario podra acceder a los formularios de registro e inicio de sesión.

<h3>Login</h3>
La página de login es un simple formulario en el que se puede introducir el correo y la contraseña, además de la opción para que recuerde y mantenga la sesión iniciada.

![image](https://user-images.githubusercontent.com/71279176/175094599-3d452828-9794-49f0-8519-f2e6e25a8247.png)

<h3>Registro</h3>
La página de registro es un formulario en el que habrá que introducir el correo, la contraseña, y el nombre de usuario.

![image](https://user-images.githubusercontent.com/71279176/175095203-89abb15f-845e-4496-b35f-8c74d45c2f6c.png)

<h3>Dashboard</h3>
Una vez iniciada sesión se accederá a la página del dashboard en la que se mostrará alguna información, y se podrán acceder al resto de páginas de la aplicación.

![image](https://user-images.githubusercontent.com/71279176/175095675-f3feed0f-9ddc-48b6-badd-2c03cae0729f.png)

<h3>Comidas</h3>

![image](https://user-images.githubusercontent.com/71279176/175122124-2441e1f1-82d2-48d2-a88b-6830d8fff331.png)

<h3>Entrenamientos</h3>

![image](https://user-images.githubusercontent.com/71279176/175122194-d6cfd580-89f7-4d3c-9a5c-60f11853e8be.png)

<h3>Recetas</h3>

![image](https://user-images.githubusercontent.com/71279176/175122248-bfa4af21-7aed-4920-9ccb-91e422eb279e.png)


<h1>Video Explicativo</h1>

https://www.youtube.com/watch?v=q644cPdZl70
