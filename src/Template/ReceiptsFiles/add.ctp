<?php
/**
  * @var \App\View\AppView $this
  */
?>
<div id="content" class="receipts form large-9 medium-8 columns content">
    <fieldset>
        <legend><?= __('Qual o tipo do comprovante?') ?></legend>
            <input type="radio" name="planeType" checked value="1" class="planeType"> Anual <br>
            <input type="radio" name="planeType" value="2" class="planeType"> Mensal
            <div id="anual">
                <?= $this->Form->create($receiptsFile, ['type' => 'file']) ?>
                    <legend><?= __('Anual') ?></legend>
                    <?php
                        echo $this->Form->radio(' ', [""], [
                            'type' => 'radio', 
                            'class' => 'plType hide', 
                            'checked', 
                            'name' => 'plType'
                        ]);
                        echo "<br>
                              <label>
                                Selecione o ano referente ao comprovante.
                              </label>";
                        echo $this->Form->control(' ', [
                            'type' => 'date', 
                            'name' => 'payment',
                            'minYear' => 2015,
                            'maxYear' => 2040,
                            'day' => false,
                            'month' => false,
                            'year' => [
                                'class' => 'cool-years',
                                'title' => 'Registration Year'
                            ]
                        ]);
                        echo "<label>Adicione todos os comprovantes referente ao ano, tipos de arquivos permitidos (zip, 7z, rar, tar.gz)</label>";
                        echo $this->Form->control(' ', [
                            'type' => 'file', 
                            'required',
                            'name' => 'file'
                        ]);
                    ?>
                    <?= $this->Form->button(__('Enviar')) ?>
                <?= $this->Form->end() ?>
            </div>
            <div id="mensal" class="hide">
                <?= $this->Form->create($receiptsFile, ['type' => 'file']) ?>
                    <legend><?= __('Mensal') ?></legend>
                    <?php
                        echo $this->Form->radio(' ', [""], [
                            'type' => 'radio', 
                            'class' => 'plType hide', 
                            'checked', 
                            'name' => 'plType'
                        ]);
                        echo "<br>
                              <label>
                                Selecione ano e mês referente ao comprovante.
                              </label>";
                        echo $this->Form->control(' ', [
                            'type' => 'date',
                            'name' => 'payment',                                                                
                            'minYear' => 2015,
                            'maxYear' => 2030,
                            'monthNames' => true,
                            'day' => false,
                            'year' => [
                                'class' => 'cool-years',
                                'title' => 'Registration Year'
                            ]
                        ]);
                        echo "<label>
                                Comprovante do plano de saúde.
                              </label>";
                        echo $this->Form->control(' ', [
                            'type' => 'file', 
                            'required', 
                            'name' => 'fileOne'
                        ]);
                        echo "<label>
                                Boleto.
                              </label>";
                        echo $this->Form->control(' ', [
                            'type' => 'file', 
                            'required', 
                            'name' => 'fileTwo'
                        ]);
                    ?>
                    <?= $this->Form->button(__('Enviar')) ?>
                <?= $this->Form->end() ?>
            </div>
    </fieldset>
</div>

