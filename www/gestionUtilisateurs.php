<?php
/**
 * Travail TPI Mai 2019
 * @copyright Gawen 2019 - CFPT-Informatique
 * @author Ackermann Gawen gawen.ackrm@edge.ch
 * @version 1.0 
 */
include_once 'server/inc/inc.all.php';

if(SessionManager::GetRole() != ROLE_ADMIN){
    header("Location:accueil.php");
}

$status = StatusManager::getAllStatus();
$users = UserManager::getUsers();
$userNickname = "";
?>
<!DOCTYPE html>
<html>

<head>
<title>Gestion des utilisateurs</title>
    <?php include_once "server/inc/head.inc.php"; ?>
</head>
    
<body>
    <?php
    include_once "server/inc/nav.inc.php";
    ?>
    <section id="services" class="section section-padded">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="createAd">

                        <h4 class="heading text-center">Gestion des utilisateurs</h4>
                        <form class="well form-horizontal frm" action="#" method="POST">
                            <fieldset>
                                <div class="form-group">
                                    <?php foreach ($users as $u) : ?>
                                        <div>
                                            <span class="col-xs-6 control-label lblForm nickname" data-nickname=<?= '"' . $u->nickname . '"' ?>><?= $u->nickname ?></span>
                                            <div class="col-md-6 inputGroupContainer">
                                                <div class="input-group inputForm">
                                                    <select class="form-control" name="status">
                                                        <?php foreach ($status as $s) {
                                                            if ($s->code === $u->status) {
                                                                echo '<option value="' . $s->code . '" selected="selected">' . $s->label . '</option>';
                                                            } else {
                                                                echo '<option value="' . $s->code . '">
                                                        ' . $s->label . '</option>';
                                                            }
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            </fieldset>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </section>
</body>
<script type="text/javascript">
    $(document).ready(function() {
        var nickname = "";
        var idStatus = -1;
        $('select').on('change', function() {
            //Pour arriver au div englobant le tout
            var parent = $(this).parent().parent().parent();
            nickname = parent.find(".nickname").data("nickname");
            idStatus = parseInt($(this).val());
            setStatus4User(nickname, idStatus);
        });
        /**
         * Modifie le status de l'utilisateur
         * @var string Le pseudonyme de l'utilisateur
         * @var int L'id du status
         * @returns string Message de confirmation de modification
         */
        function setStatus4User(n, status) {
            $.ajax({
                type: 'POST',
                url: 'server/ajax/ajaxModifyUsersStatus.php',
                dataType: 'json',
                data: {
                    "nickname": n,
                    "idStatus": status
                },
                success: function(returnedData) {
                    var res = returnedData;

                },
                error: function(xhr, tst, err) {
                    console.log(err);
                }
            });
        }
    });
</script>

</html>