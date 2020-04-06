<?php

/*
 * ARQUIVO DE ENVIO DE E-MAIL.
 * Envia um e-mail de aniversário para os Funcionários
 * 2020-04-06 - HOX | Agencia Hox
 */
require __DIR__ . "/vendor/autoload.php";

use Source\Support\Email;

$email = new Email();

// CRIANDO A CONEXÃO COM O BANCO DE DADOS
$conn = new mysqli(SIS_DB_HOST, SIS_DB_USER, SIS_DB_PASS, SIS_DB_DBSA);
if ($conn->connect_error) {
    die("Erro na Conexão: " . $conn->connect_error);
}
// SELECIONANDO OS DADOS DOS CLIENTES NO BANCO
$sql = "SELECT user_name, user_birth, user_genre, user_email  FROM ws_users WHERE  DATE_FORMAT(user_birth, '%d-%m') = DATE_FORMAT('1986-01-05', '%d-%m') AND user_id = '1'";
$result = $conn->query($sql);
//LOOP
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $genero = ($row['user_genre'] == 1 ? 'do' : 'da');
        $aniversariante = $row['user_name'];
        $MailContent = '<table width="550" style="font-family: "Trebuchet MS", sans-serif;">
                            <tr>
                                <td>
                                    <font face="Trebuchet MS" size="3">
                                     <h2>Feliz Aniversário ' . $aniversariante . '</h2>
                                     <p>Meus parabéns!</p>
                                     <p>Que você complete muitos anos de vida, sempre com saúde, amor e felicidade.</p>
                                     <p>Desejamos o melhor para você e não só hoje, mas sempre, e que esta data se repita muitos anos.</p>
                                     <p>São os votos de seus amigos e de toda Equipe da Maritucs :)</p>
                                     <br>
                                    </font>
                                </td>
                            </tr>
                            <tr><td><img src="' . BASE . '/img/bolo.png" alt="bolo" title="bolo" /></td></tr>
                            <tr>
                                <td>
                                 <hr>
                                    <p style="font-size: 0.875em;">
                                    <img src="' . BASE . '/img/favicon.png" alt="Kuky Confeitos" title="Kuky Confeitos" /><br>
                                     Maritucs Alimentos Ltda | Kuky Confeitos<br>Telefone: ' . SITE_ADDR_PHONE_A . '<br>E-mail: ' . SITE_ADDR_EMAIL . '<br>
                                     <a title="' . SITE_NAME . '" href="' . BASE . '">' . SITE_ADDR_SITE . '</a><br>' . SITE_ADDR_ADDR . ' ' . SITE_ADDR_CITY . '/' . SITE_ADDR_UF . ' - ' . SITE_ADDR_ZIP . '<br>
                                    </p>
                                </td>
                            </tr>
                            <tr>
                                <td><p>Feito com &#10084; Equipe TI Maritucs</p></td>
                                <td></td>
                              </tr>
                         </table>
                        <style>body, img{max-width: 550px !important; height: auto !important;} p{margin-botton: 15px 0 !important;}</style>';
        $email->add(
                "Parabéns {$aniversariante}! Hojé é o seu dia :)",
                $MailContent,
                "Felicidades {$aniversariante}!",
                "{$row["user_email"]}"
        )->send("Equipe Maritucs Alimentos Ltda", "ti@maritucs.com.br");
        sleep(1);
    }

    // SELECIONANDO OS DADOS DOS CLIENTES QUE NÃO FAZEM ANIVERSÁRIO PARA INFORMAR!S
//$sql2 = "SELECT user_name, user_birth, user_genre, user_email  FROM ws_users WHERE  DATE_FORMAT(user_birth, '%d-%m') != DATE_FORMAT(CURRENT_DATE, '%d-%m')";
    $sql2 = "SELECT user_name, user_birth, user_genre, user_email  FROM ws_users WHERE  DATE_FORMAT(user_birth, '%d-%m') = DATE_FORMAT('1986-01-05', '%d-%m') AND user_id = '17'";
    $resultperson = $conn->query($sql2);
//LOOP
    if ($resultperson->num_rows > 0) {
        while ($rows = $resultperson->fetch_assoc()) {

            $MailContentPerson = '<table width="550" style="font-family: "Trebuchet MS", sans-serif;">
                            <tr>
                            <td>
                                <font face="Trebuchet MS" size="3">
                                 <h2>Hoje é aniversário ' . $genero . ' ' . $aniversariante . '</h2>
                                 <p>Só passei para te avisar ' . $rows['user_name'] . ' que o dia está especial hoje!</p>
                                 <p>É o aniversário ' . $genero . ' <b>' . $aniversariante . '</b>, não se esqueça de desejar uma felicidade imensa e com muita alegria sem limite!</p>
                                 <p>Afinal é mais um ano de vida juntos aqui na empresa, dividindo o mesmo espaço e celebrando a vida ao lado das pessoas que temos muitas histórias juntos!</p>
                                 <p>Que a felicidade contagie todos hoje!</p>
                                </font>
                            </td>
                            </tr>
                            <tr><td><img src="' . BASE . '/img/confeito.png" alt="bolo" title="bolo" /><img src="' . BASE . '/img/festa.png" alt="bolo" title="bolo" /><img src="' . BASE . '/img/confeito.png" alt="bolo" title="bolo" /></td></tr>
                            <tr>
                                <td>
                                 <hr>
                                    <p style="font-size: 0.875em;">
                                    <img src="' . BASE . '/img/favicon.png" alt="Kuky Confeitos" title="Kuky Confeitos" /><br>
                                     Maritucs Alimentos Ltda | Kuky Confeitos<br>Telefone: ' . SITE_ADDR_PHONE_A . '<br>E-mail: ' . SITE_ADDR_EMAIL . '<br>
                                     <a title="' . SITE_NAME . '" href="' . BASE . '">' . SITE_ADDR_SITE . '</a><br>' . SITE_ADDR_ADDR . ' ' . SITE_ADDR_CITY . '/' . SITE_ADDR_UF . ' - ' . SITE_ADDR_ZIP . '<br>
                                    </p>
                                </td>
                            </tr>
                            <tr>
                                <td><p>Feito com &#10084; Equipe TI Maritucs</p></td>
                                <td></td>
                              </tr>
                         </table>
                        <style>body, img{max-width: 550px !important; height: auto !important;} p{margin-botton: 15px 0 !important;}</style>';
            $email->add(
                    "Hoje é dia de Festa {$rows['user_name']}! Hojé é o aniversário {$genero} {$aniversariante}",
                    $MailContentPerson,
                    "Vamos dar os parabéns!",
                    "{$rows["user_email"]}"
            )->send("Equipe Maritucs Alimentos Ltda", "ti@maritucs.com.br");
            sleep(1);
        }
    }//encerra a parte dos outros funcionários
}else{
    echo "<p>Nenhum aniversariate do dia! :)</p>";
}


$conn->close();
