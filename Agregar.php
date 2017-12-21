<?php
require_once 'function.php';
require_once 'config.php';

$alm = new pdv_var();
$model = new consulta();

 
 if(isset($_REQUEST['action']))
{
	switch($_REQUEST['action'])
	{
		case 'actualizar':
			$alm->__SET('id',              $_REQUEST['id']);
            $alm->__SET('name',         $_REQUEST['name']);
			$alm->__SET('lastname',     $_REQUEST['lastname']);
		    $alm->__SET('email',        $_REQUEST['email']);
			$alm->__SET('pass',         $_REQUEST['pass']);

			$model->update($alm);
			header('Location: test.php');
			break;

		case 'registrar':
			$alm->__SET('name',         $_REQUEST['name']);
			$alm->__SET('lastname',     $_REQUEST['lastname']);
            $alm->__SET('email',        $_REQUEST['email']);
            $alm->__SET('rol',        '2');
			$alm->__SET('pass',         (substr((sha1(substr((strrev(md5($_REQUEST['pass']))),0,20))),3,23)));

            

			$model->register($alm);
		//	header('Location: test.php');
			break;

		case 'eliminar':
			$model->delete($_REQUEST['id']);
			header('Location: test.php');
			break;

		case 'editar':
			$alm = $model->getdata($_REQUEST['id']);
			break;
	}
}
?>


<br>
<br>
<br>

                <form action="?action=<?php echo $alm->id > 0 ? 'actualizar' : 'registrar'; ?>" method="post" class="pure-form pure-form-stacked" style="margin-bottom:30px;">
                    <input type="text" name="id" value="<?php echo $alm->__GET('id'); ?>" />
                    
                    <table style="width:500px;">
                        <tr>
                            <th style="text-align:left;">NOMBRE</th>
                            <td><input type="text" name="name" value="<?php echo $alm->__GET('name'); ?>" style="width:100%;" /></td>
                        </tr>
                        <tr>
                            <th style="text-align:left;">APELLIDO</th>
                            <td><input type="text" name="lastname" value="<?php echo $alm->__GET('lastname'); ?>" style="width:100%;" /></td>
                        </tr>
                        <tr>
                            <th style="text-align:left;">ROL</th>
                            <td>
                                <select name="rol" style="width:100%;" >
                                    <option value="0">Seleccionar</option>
                                    <option value="ADMIN" <?php echo $alm->__GET('rol') == 1 ? 'selected' : ''; ?>>ADMIN</option>
                                    <option value="OTRO" <?php echo $alm->__GET('rol') == 2 ? 'selected' : ''; ?>>OTRO</option>
                                </select>
                            </td>
                        </tr>

                        <tr>
                            <th style="text-align:left;">EMAIL</th>
                            <td><input type="text" name="email" value="<?php echo $alm->__GET('email'); ?>" style="width:100%;" /></td>
                        </tr>

                        <tr>
                            <th style="text-align:left;">CONTRASEÑA</th>
                            <td><input type="password" name="pass" value="<?php echo $alm->__GET('pass'); ?>" style="width:100%;" /></td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <button type="submit" class="pure-button pure-button-primary">Guardar</button>
                            </td>
                        </tr>
                    </table>
                </form>
                 
       <br><br><br>

                <table class="pure-table pure-table-horizontal">
                    <thead>
                        <tr>
                            <th style="text-align:left;">Nombre</th>
                            <th style="text-align:left;">Apellido</th>
                            <th style="text-align:left;">Rol</th>
                            <th style="text-align:left;">Email</th>
                            <th style="text-align:left;">Contraseña</th>
                            <th></th>
                            <th></th>
                        </tr>
                    </thead>
                   
                    <?php foreach($model->select() as $r): ?>
                        <tr>
                            <td> <?php echo $r->__GET('name'); ?></td>
                            <td><?php echo $r->__GET('lastname'); ?></td>
                            <td><?php echo $r->__GET('rol') == 1 ? 'ADMIN' : 'OTRO'; ?></td>
                            <td><?php echo $r->__GET('email'); ?></td>
                            <td><?php echo $r->__GET('pass'); ?></td>
                            <td>
                                <a href="?action=editar&id=<?php echo $r->id; ?>">Editar</a>
                            </td>
                            <td>
                                <a href="?action=eliminar&id=<?php echo $r->id; ?>">Eliminar</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
            
                </table>     
