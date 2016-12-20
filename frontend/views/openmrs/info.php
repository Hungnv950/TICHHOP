<?php

?>

<div class="panel panel-default create">
    <div class="panel-heading">Info Person</div>

    <table class="create">
        <tr>
            <td width="100px" align="center">ID</td>
            <td><?php echo $info['uuid']?></td>
        </tr>
        <tr>
            <td width="100px" align="center">Name</td>
            <td><?php echo $info['display']?></td>
        </tr>
        <tr>
            <td width="100px" align="center">Gender</td>
            <td><?php if($info['gender']=="M"){ echo "Male";}else{echo "Femalle";}?></td>
        </tr>
        <tr>
            <td width="100px" align="center">Age</td>
            <td><?php if($info['age']!=null) echo $info['age']; else echo "NULL"; ?></td>
        </tr>
        <tr>
            <td width="100px" align="center">Birthdate</td>
            <td><?php if($info['birthdate']!=null) echo $info['birthdate']; else echo "NULL"; ?></td>
        </tr>
        <tr>
            <td width="100px" align="center">Dead</td>
            <td><?php if($info['dead']) echo "True"; else echo "False"; ?></td>
        </tr>
        <?php if($info['deathDate']!=null){?>
            <tr>
                <td width="100px" align="center">deathDate</td>
                <td><?php echo $info['deathDate'];?></td>
            </tr>
        <?php } ?>
    </table>
</div>
