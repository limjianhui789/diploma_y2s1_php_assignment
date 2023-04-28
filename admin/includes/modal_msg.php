<?php 
    function modal_msg($msg, $title ,$link){
        
        if(trim($link) == ""){
            $link = null;
        }elseif(trim($link) == "history.back()"){
            $link = "onclick=\"history.back()\"";
        }else {
            $link = "onclick=\"location.href='".$link."'\"";
        }
        printf ('
        <div class="modal fade" data-bs-backdrop="static" tabindex="-1" id="result" aria-modal="true" role="dialog" style="display: block;">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">%s</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" %s></button>
            </div>
            <div class="modal-body">        
                <ul>
        ',$title ,$link);

        foreach($msg as $x){
            printf('
                
                <li>%s</li> 
            ', $x);
        }

        printf('
                </ul>
            </div>
            <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" %s>Close</button>
        </div>
            </div>
            </div>
        </div>
        ', $link);

        echo '
            <script>
                const myModal = new bootstrap.Modal("#result", {
                    keyboard: false
                    })
                myModal.show()
            </script>
        ';
    }
    function require_modal(){
        echo '
            <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.5/dist/umd/popper.min.js" integrity="sha384-Xe+8cL9oJa6tN/veChSP7q+mnSPaj5Bcu9mPX5F5xIGE0DVittaqT5lorf0EI7Vk" crossorigin="anonymous"></script>
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.min.js" integrity="sha384-ODmDIVzN+pFdexxHEHFBQH3/9/vQ9uori45z4JjnFsRydbmQbmL5t1tQ0culUzyK" crossorigin="anonymous"></script>
            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
        ';
    }
?>