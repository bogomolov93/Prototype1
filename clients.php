<?php
session_start();
include("functions.inc.php");
if (validate_user($_SESSION['service_user_id'], $_SESSION['code'])) {
include("inc/head.php");
include("inc/head.inc.php");
?>

<div class="container" style="position:relative;width:90%;">

    <div class="col-xs-2" style="left:-16px;">
        <select class="form-control">
            <option>Салон 1</option>
            <option>Салон 2</option>
            <option>Салон 3</option>
        </select>
    </div>

    <div class="input-group-btn" style="position:absolute; right:222px; ">
        <button type="button" style="margin-right:10px;" class="btn">
            Смотреть на карте
        </button>
        <button type="button" class="btn">
            Ретинг
        </button>
    </div>


    <div style="margin-top: 1%;">
        <div class="w3-container w3-Light-Gray col-xs-12">
            <div class="col-sm-6" style="margin-top:1%;">
                <form>
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Найти клиента">
                        <div class="input-group-btn">
                            <button class="btn btn-default" type="submit">
                                <i class="glyphicon glyphicon-search w3-xlarge"></i>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
            <div style="margin-top:1%;">
                <button class="btn btn-default">
                    Выбрать по параметрам
                </button>
                <button class="btn btn-default">
                    Сбросить результаты
                </button>
            </div>
            <div class="w3-container">
                <p class="w3-small w3-text-gray">Начните вводить имя, телефон, район или точный адрес клиента</p>
            </div>
        </div>
    </div>

    <div>
        <button class="btn btn-primary" style="margin-top:1%;height:40px;" data-toggle="modal" data-target="#myModal">
            Добавить нового клиента
        </button>
        <!-- Modal -->
        <div class="modal fade" id="myModal" role="dialog">
            <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content" style="width: 400px;">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Новый клиент</h4>
                    </div>
                    <div class="modal-body">
                        <form id="form_add_client">
                            <div class="form-group">
                                <label for="client_name" class="w3-opacity w3-text-gray"
                                       style="font-size:10pt;">Имя*</label>
                                <input type="text" class="col-sm-6" style="position:absolute; left:180px;"
                                       name="client_name" id="client_name">
                            </div>
                            <div class="form-group">
                                <label for="client_middle_name" class="w3-opacity w3-text-gray" style="font-size:10pt;">Фамилия*</label>
                                <input type="text" class="col-sm-6" style="position:absolute; left:180px;"
                                       name="client_middle_name" id="client_middle_name">
                            </div>
                            <div class="form-group">
                                <label for="client_last_name" class="w3-opacity w3-text-gray" style="font-size:10pt;">Отчество*</label>
                                <input type="text" class="col-sm-6" style="position:absolute; left:180px;"
                                       name="client_last_name" id="client_last_name">
                            </div>
                            <div class="form-group">
                                <label for="client_birthday" class="w3-opacity w3-text-gray" style="font-size:10pt;">Дата
                                    рождения*</label>
                                <div class='col-sm-7' style="position:absolute; left:164px; top: 137px;">
                                    <input type='text' class="form-control" style="height:30px;" id='client_birthday'/>
                                </div>
                                <script type="text/javascript">
                                    $(function () {
                                        $('#client_birthday').datetimepicker({
                                            format: 'YYYY-MM-DD',
                                            locale: 'ru'
                                        });
                                    });
                                </script>
                            </div>
                            <div class="form-group">
                                <label for="client_tel" class="w3-opacity w3-text-gray"
                                       style="font-size:10pt;">Телефон*</label>
                                <input type="text" class="col-sm-6" style="position:absolute; left:180px;"
                                       name="client_tel" id="client_tel">

                                <script type="text/javascript">
                                    jQuery(function ($) {
                                        $.mask.definitions['~'] = '[+-]';

                                        $('#client_tel').mask('(999) 999-9999');
                                    });
                                </script>
                            </div>
                            <div class="form-group">
                                <label for="client_email" class="w3-opacity w3-text-gray" style="font-size:10pt;">Электронная
                                    почта</label>
                                <input type="text" class="col-sm-6" style="position:absolute; left:180px;"
                                       name="client_email" id="client_email">
                            </div>
                            <div class="form-group">
                                <label for="client_skype" class="w3-opacity w3-text-gray"
                                       style="font-size:10pt;">Skype</label>
                                <input type="text" class="col-sm-6" style="position:absolute; left:180px;"
                                       name="client_skype" id="client_skype">
                            </div>
                            <div class="form-group">
                                <label for="client_region" class="w3-opacity w3-text-gray"
                                       style="font-size:10pt;">Район</label>
                                <input type="text" class="col-sm-6" style="position:absolute; left:180px;"
                                       name="client_region" id="client_region">
                            </div>
                            <div class="form-group">
                                <label for="client_adr" class="w3-opacity w3-text-gray"
                                       style="font-size:10pt;">Адрес </label>
                                <input type="text" class="col-sm-6" style="position:absolute; left:180px;"
                                       name="client_adr" id="client_adr">
                            </div>
                            <div class="form-group">
                                <label for="client_learned" class="w3-opacity w3-text-gray" style="font-size:10pt;">Как
                                    узнал(а)</label>
                                <div class="col-sm-7" style="position:absolute; left:165px; top:375px;">
                                    <select class="form-control" style="height:30px;" name="client_learned"
                                            id="client_learned">
                                        <option value="" selected></option>
                                        <option value="1">Реклама</option>
                                        <option value="2">Друзья</option>
                                        <option value="3">Другое</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="client_cons" class="w3-opacity w3-text-gray" style="font-size:10pt;">Консультант</label>
                                <div class="col-sm-7" style="position:absolute; left:165px; top:415px;">
                                    <select class="form-control" style="height:30px;" name="client_cons"
                                            id="client_cons">
                                        <option value="" selected></option>
                                        <?php $stmt = $dbConnection->prepare('SELECT id_user, fio FROM users where is_admin = "0"');
                                        $stmt->execute(array());
                                        $res1 = $stmt->fetchAll();
                                        foreach ($res1 as $row) {

                                            ?>
                                            <option value="<?php echo $row['id_user']; ?>"><?php echo $row['fio']; ?></option>
                                        <?php }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="client_event" class="w3-opacity w3-text-gray" style="font-size:10pt;">Событие</label>
                                <div class="col-sm-7" style="position:absolute; left:165px; top:456px;">
                                    <select class="form-control" style="height:30px;" name="client_event"
                                            id="client_event">
                                        <option value="" selected></option>
                                        <?php $stmt = $dbConnection->prepare('SELECT id_event, value FROM evens');
                                        $stmt->execute(array());
                                        $res1 = $stmt->fetchAll();
                                        foreach ($res1 as $row) {

                                            ?>
                                            <option value="<?php echo $row['id_event']; ?>"><?php echo $row['value']; ?></option>
                                        <?php }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="client_status" class="w3-opacity w3-text-gray" style="font-size:10pt;">Статус*</label>
                                <div class="col-sm-7" style="position:absolute; left:165px; top:498px;">
                                    <select class="form-control" style="height:30px;" name="client_status"
                                            id="client_status">
                                        <option value="" selected></option>
                                        <?php $stmt = $dbConnection->prepare('SELECT id_status, value FROM status_clients');
                                        $stmt->execute(array());
                                        $res1 = $stmt->fetchAll();
                                        foreach ($res1 as $row) {

                                            ?>
                                            <option value="<?php echo $row['id_status']; ?>"><?php echo $row['value']; ?></option>
                                        <?php }
                                        ?>
                                    </select>
                                </div>
                            </div>

                        </form>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-primary" id="add_client">Добавить</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Закрыть</button>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <table class="w3-table w3-striped" style="margin-top:1%; background-color: rgb(255,255,255); width:100%;">
        <tr>
            <th>Имя</th>
            <th>Отчество</th>
            <th>Фамилия</th>
            <th>Профиль заполнен</th>
            <th>Возраст</th>
            <th>Статус</th>
            <th>Сеансы</th>
            <th>Пропуски</th>
            <th>Не был дней</th>
            <th>Покупок</th>
            <th>Телефон</th>
        </tr>
        <tbody>
        <?php
        $stmt = $dbConnection->prepare('SELECT cl.id_client,cl.tel,first_name,last_name,middle_name,birthday,st_c.value FROM clients cl join status_clients st_c
on cl.id_status=st_c.id_status order by cl.id_client');
        $stmt->execute(array());
        $res = $stmt->fetchAll();
        if (!empty($res)) {
            foreach ($res as $row) {
                $birthday = $row['birthday'];
                $stmt = $dbConnection->prepare('select 
												id_client
												,max( case when is_come = 1 then date_visit else null end ) as last_visit
												,sum( case when is_come = 1 then 1  else 0 end ) 			as count_in
												,sum( case when is_come = 0 then 1  else 0 end ) 			as count_lose
											from visits
											where id_client=:id
											group by id_client');
                $stmt->execute(array(':id' => $row['id_client']));
                $count = $stmt->fetch(PDO::FETCH_ASSOC);

                $stmt = $dbConnection->prepare('SELECT us.id_user, us.fio FROM clients cl
                                                            join users us
                                                            on cl.id_user = us.id_user
                                                            where cl.id_client = :idd');
                $stmt->execute(array(':idd' => $row['id_client']));
                $cons = $stmt->fetch(PDO::FETCH_ASSOC);

                $stmt = $dbConnection->prepare('SELECT god.name FROM clients cl
                                                            join purchases pur
                                                            on cl.id_client=pur.id_client
                                                                join goods god
                                                                on pur.id_good=god.id_good
                                                                where cl.id_client = :idd');
                $stmt->execute(array(':idd' => $row['id_client']));
                $purchase = $stmt->fetch(PDO::FETCH_ASSOC);

                $last_visit = date_diff(new DateTime(), new DateTime($count['last_visit']))->days;
                if ($last_visit == 0) {
                    $last_visit = "Отсутствует";
                }
                $str = strval($row['tel']);
                $str = '+' . substr($str, 0, 1) . '(' . substr($str, 1, 3) . ')' . substr($str, 4, 3) . '-' . substr($str, 7, 2) . '-' . substr($str, 9, 2);
                ?>
                <tr id="check_profile">
                    <td><?php echo $row['first_name']; ?></td>
                    <td><?php echo $row['last_name']; ?></td>
                    <td><?php echo $row['middle_name']; ?></td>
                    <td></td>
                    <td style="display: none"><?php echo $cons['fio']; ?></td>
                    <td style="text-align:center;"><?php echo calculate_age($birthday); ?></td>
                    <td style="text-align:center;"><?php echo $row['value']; ?></td>
                    <td style="text-align:center;"><?php echo $count['count_in']; ?></td>
                    <td style="text-align:center;"><?php echo $count['count_lose']; ?></td>
                    <td style="text-align:center;"><?php echo $last_visit; ?></td>
                    <td></td>
                    <td style="text-align:center;"><?php echo $str; ?></td>
                    <td style="display: none"><?php echo $purchase['name']; ?></td>
					<td style="display: none"><?php echo $row['id_client']; ?></td>
                </tr>
                <?php
            }
        } ?>
        </tbody>
    </table>
    <div class="container">
        <div class="modal fade" id="checklist" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <u style="font-size: 20px;" class="modal-title" id="fio"></u>
                    </div>
                    <div class="modal-body">
                        <p id="age" style="font-size: 15px;"></p>
                        <p style="font-size: 15px;"> Сеансы - <i id="visits" style="margin-right: 15px"></i> Пропуски -
                            <i id="lose" style="margin-right: 15px"></i> Дней не был - <i id="no_visit"></i></p>
                        <p id="tel" style="font-size: 15px;"></p>
                        <p id="consultant" style="font-size: 15px;"></p>
                        <p id="purchase" style="font-size: 15px;"></p>
                    </div>
                    <div class="modal-footer" style="position: relative">
                        <button type="button" style="position: absolute; left: 15px" class="btn btn-primary">Записать
                        </button>
                        <button type="button" id="open_profile" style="position: absolute; left: 100px"
                                class="btn btn-default">Открыть профиль
                        </button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Закрыть</button>
                    </div>
                </div>

            </div>
        </div>

    </div>
    <?php
    } else {
        include 'auth.php';
    }
    ?>
