<div class="right_s">
    <div>
        <h3><?php if (isset($error) && $error != '')
    echo $error;
else
    echo 'Произошла ошибка ';
echo $this->email->print_debugger();
?></h3>
    </div>
</div>
</div>