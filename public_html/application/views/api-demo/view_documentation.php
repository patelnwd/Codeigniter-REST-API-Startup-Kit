<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Codigniter REST API Documentation</title>
    <?php
        $basic_libs = ['j_query','bootstrap','font_awesome'];
        linkSiteIcon(base_url('assets/site-images/fav-icon-64.png'));        
        load_ui_library($basic_libs);
    ?>
</head>
<body>
    <div class="container container-fluid">
        <br>        
        <div class="row">            
            <div class="col-12">
                <div class="jumbotron">
                    <h1 class="display-4">REST API Startup Kit</h1>
                    <p class="lead">This REST API developed through Codigniter v3.1.11</p>
                    <hr class="my-4">
                    <p><b>Preloaded UI Librarys are:</b></p>
                    <div>
                        <span class="badge badge-dark">Bootstrap v4.4.1</span>
                        <span class="badge badge-dark">CryptoJS v3.1.2</span>
                        <span class="badge badge-dark">FontAwesome v5.13.0</span>
                        <span class="badge badge-dark">JQuery Confirm v3.3.4</span>
                        <span class="badge badge-dark">JQuery-UI v1.12.1</span>
                        <span class="badge badge-dark">JQuery v3.5.0</span>
                    </div>
                    <hr class="my-4">
                    <p><b>Preloaded Library are:</b></p>
                    <div>
                        <span class="badge badge-dark">REST_Controller</span>
                        <span class="badge badge-dark">JWT</span>
                    </div>
                    <hr class="my-4">
                    <p class="text-center">Documentation of API and database given in Docs folder</p>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <h4>API Samples</h4>
            </div>
            <div class="col-12">
                <?php foreach($api_list as $index => $list): ?>
                <div class="card">
                    <div class="card-body">
                        <p><span class="badge badge-info">#<?= $index+1 ?></span> <span class="badge badge-dark">API Name</span> <span class="text-primary"><?=  $list->name; ?></span></p>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text bg-dark text-warning" id="basic-addon3"><strong><?= $list->request->method ?></strong></span>
                            </div>
                            <input type="text" class="form-control" id="basic-url" aria-describedby="basic-addon3" value="<?= $list->request->url->raw ?>">
                        </div>
                        <div class="request-div">                                                        
                            <?php if(count($list->request->header) > 0): ?>
                                <p><strong>Headers</strong></p>
                                <div class="table-responsive">
                                    <table class="table table-bordered table-striped table-sm">
                                        <thead class="thead-dark">
                                            <tr>
                                                <th>KEY</th>
                                                <th>TYPE</th>
                                                <th>VALUE</th>
                                            </tr>
                                        </thead>
                                        <tbody>                                    
                                            <?php foreach($list->request->header as $h): ?>                                    
                                            <tr>
                                                <th><?= $h->key ?></th>
                                                <td><?= $h->type ?></td>
                                                <td><?= $h->value ?></td>                                        
                                            </tr>                                    
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                            <?php endif; ?>
                            <?php if(isset($list->request->body)):?>
                            <p><strong>Body</strong> <span class="text-muted"><?= $list->request->body->mode ?></span></p>
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-sm">
                                    <thead class="thead-dark">
                                        <tr>
                                            <th>KEY</th>
                                            <th>TYPE</th>
                                            <th>VALUE</th>
                                        </tr>
                                    </thead>
                                    <tbody>                                    
                                        <?php foreach($list->request->body->{$list->request->body->mode} as $payload): ?>                                    
                                        <tr>
                                            <th><?= $payload->key ?></th>
                                            <td><?= $payload->type ?></td>
                                            <td><?= $payload->value ?></td>
                                        </tr>                                    
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                            <?php endif; ?>
                            <p class="text-success"><strong>Success Response:</strong></p>
                            <div class="resp-success">
                                <textarea class="source-json" name="success_<?= $index ?>" id="success_<?= $index ?>" cols="10" rows="1" hidden><?= json_encode($list->response->success) ?></textarea>
                                <pre class="pretty-json"></pre>
                            </div>
                            <p class="text-danger"><strong>Error Response:</strong></p>
                            <div class="resp-error">
                                <textarea class="source-json" name="error_<?= $index ?>" id="error_<?= $index ?>" cols="10" rows="1" hidden><?= json_encode($list->response->error) ?></textarea>
                                <pre class="pretty-json"></pre>
                            </div>
                        </div>
                        <div class="response-div"></div>
                    </div>
                </div>    
                <br>       
                <?php endforeach; ?> 
            </div>
        </div>
    </div>
    <?php load_ui_library($basic_libs, 'js'); ?>
    <?php load_ui_library(['beautify_json'], 'js');?>
    <script>
        const displayJson = () => {
            let success_json_area = $('.resp-success');
            $.each(success_json_area, function(i,v){
                let jsonData = JSON.parse($(v).find('.source-json').val());
                let target = $(v).find('.pretty-json');
                console.log(jsonData);
                console.log(target);
                var editor = new JsonEditor(target);
                editor.load(jsonData);
            });

            let error_json_area = $('.resp-error');
            $.each(error_json_area, function(i,v){
                let jsonData = JSON.parse($(v).find('.source-json').val());
                let target = $(v).find('.pretty-json');
                console.log(jsonData);
                console.log(target);
                var editor = new JsonEditor(target);
                editor.load(jsonData);
            });
        };

        $(function(){
            displayJson();            
        });
    </script>    
</body>
</html>