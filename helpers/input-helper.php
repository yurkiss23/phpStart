<?php
function create_input($name, $label, $type, $errors)
{
    $value = '';
    $isInvalid = '';
    $isError = false;
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
//        $value = '';
        $isValue = isset($_POST[$name]) and !empty($_POST[$name]);
        if ($isValue)
            $value = $_POST[$name];

//        $isInvalid='';
        $isError = isset($errors[$name]) and !empty($errors[$name]);
        $isInvalid = $isError ? 'is-invalid' : '';

    }
    print <<<END
                <div class="form-group">
                    <label for="$name">$label</label>
                    <input type="$type"
                           class="form-control $isInvalid"
                           name="$name"
                           id="$name"
                           value="$value"/>
                
    END;

    if ($isError)
        print <<<ERROR
            <div class="invalid-feedback d-block">
                $errors[$name]
            </div>
        ERROR;

    echo '</div>';
}

?>