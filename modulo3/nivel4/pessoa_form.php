
<?php
require_once 'db/pessoa_db.php';
$pessoa = [];
$pessoa['id'] = '';
$pessoa['nome'] = '';
$pessoa['endereco'] = '';
$pessoa['bairro'] = '';
$pessoa['telefone'] = '';
$pessoa['email'] = '';
$pessoa['id_cidade'] = '';
if (!empty($_REQUEST['action'])) {
    if ($_REQUEST['action'] == 'edit') {
        if (!empty($_GET['id'])) {
            $id = (int) $_GET['id'];
            $pessoa = get_pessoa($id);
        }
    } else if ($_REQUEST['action'] == 'save') {
        $id = $_POST['id'];
        $pessoa = $_POST;

        if (empty($_POST['id'])) {
            $pessoa['id'] = get_next_pessoa();
            $result = insert_pessoa($pessoa);
        } else {
            $result = update_pessoa($pessoa);
        }
        print ($result) ? 'Registro salvo com sucesso' : 'Algo deu errado';
    }
}
require_once 'lista_combo_cidades.php';
$cidades = lista_combo_cidades($pessoa['id_cidade']);

$form = file_get_contents('html/form.html');
$form = str_replace('{id}', $pessoa['id'], $form);
$form = str_replace('{nome}', $pessoa['nome'], $form);
$form = str_replace('{endereco}', $pessoa['endereco'], $form);
$form = str_replace('{bairro}', $pessoa['bairro'], $form);
$form = str_replace('{telefone}', $pessoa['telefone'], $form);
$form = str_replace('{email}', $pessoa['email'], $form);
$form = str_replace('{id_cidade}', $pessoa['id_cidade'], $form);
$form = str_replace('{cidades}', $cidades, $form);

print $form;

?>
