<?php

class ajaxController extends controller {

    public function __construct() {
        parent::__construct();
    }

    public function index() {
        $dados = array();
    }

    public function getChamado() {
        $dados = array();

        $c = new chamados();
        $dados['chamados'] = $c->getChamados();

        echo json_encode($dados);
    }

    public function sendmessage() {
        if (isset($_POST['msg']) && !empty($_POST['msg'])) {
            $msg = addslashes($_POST['msg']);
            $idchamado = $_SESSION['chatwindow'];
            if ($_SESSION['area'] == 'suporte') {
                $origem = 0;
            } else {
                $origem = 1;
            }

            $m = new mensagens();
            $m->sendMessage($idchamado, $origem, $msg);
        }
    }

    public function getmessage() {
        $dados = array();

        $m = new mensagens();
        $c = new chamados();

        $idchamado = $_SESSION['chatwindow'];
        $area = $_SESSION['area'];
        $lastmsg = $c->getLastMsg($idchamado, $area);

        $dados['mensagens'] = $m->getMessage($idchamado, $lastmsg);

        echo json_encode($dados);
    }

}
