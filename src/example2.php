<?php
  header('Content-Type: text/html; charset=utf-8');
  session_name('PRO23');
  session_start();

	if (isset($_REQUEST['q'])) {
    $q = $_REQUEST['q'];
    $output = <<<FOUND
      <p>Вы искали &mdash; <strong>$q</strong></p>
      <p>К сожалению, по вашему запросу ничего не найдено!</p>
FOUND;
	}
	else {
		$output = "<p>Вы пока ничего не искали</p>";
	}


  echo <<<HTML
  <table width="600" cellpadding="20">
    <tr bgcolor="#eaeaea" valign="top">
      <td>
        <h1>Бабушкино лукошко</h1>
        <p>Найди свое любимое печенье!</p>
        
        <form method="get" autocomplete="off">
          <p>
            <input type="text" name="q" size="60">
          </p>
          <p>
            <input type="submit" value="Искать">
          </p>
        </form>

        <h2>Результаты поиска</h2>
        $output
      </td>
      <td bgcolor="silver"  width="150" valign="top">
        <h4>Авторизация</h4>
        <form action="login.php" method="post" autocomplete="off">
          <p>
            <input type="text" name="username" size="20">
          </p>
          <p>
            <input type="password" name="password" size="20">
          </p>
          <p>
            <input type="submit" value="Войти">
          </p>
        </form>
      </td>
    </tr>
  </table>


HTML;
