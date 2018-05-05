<?php require_once 'php/conn.php';?>
<h1>NFe Armazenadas</h1>
<table border="0" class="table">
    <tr>
        <td>ID</td>
        <td>CHAVE</td>
        <td>CNPJ</td>
        <td>IE</td>
        <td>NOME</td>
        <td>DATA EMISSÃO</td>
        <td>STATUS</td>
        <td colspan="2">AÇÕES</td>
    </tr>
    <?php
        $read_xml = mysqli_query($conexao, "SELECT * FROM nfe ORDER BY id DESC");
        if(mysqli_num_rows($read_xml) > '0'){
            foreach($read_xml as $read_xml_view){
                if($read_xml_view['status'] == '0'){
                    $desc_status = 'Gravada';
                }elseif($read_xml_view['status'] == '1'){
                    $desc_status = 'Manifestada';
                }elseif($read_xml_view['status'] == '2'){
                    $desc_status = 'Baixada';
                }
    ?>
    <tr>
        <td><?php echo $read_xml_view['id'];?></td>
        <td><?php echo $read_xml_view['chNFe'];?></td>
        <td><?php echo $read_xml_view['CNPJ'];?></td>
        <td><?php echo $read_xml_view['IE'];?></td>
        <td><?php echo $read_xml_view['xNome'];?></td>
        <td><?php echo $read_xml_view['dhEmi'];?></td>
        <td><?php echo $desc_status;?></td>
        <td><a href="nfephp-master/XML/producao/temporarias/<?php echo $read_xml_view['pasta'];?>/<?php echo $read_xml_view['chNFe'];?>-retDownnfe.xml" target="_blank" class="btn btn-primary">Baixar</a></td>
        <td><a href="php/danfe.php?chave=<?php echo $read_xml_view['chNFe'];?>&pasta=<?php echo $read_xml_view['pasta'];?>" target="_blank" class="btn btn-success">Danfe</a></td>
    </tr>
    <?php
            }
        }
    ?>
</table>