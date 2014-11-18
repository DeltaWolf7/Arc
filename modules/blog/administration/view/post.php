<div class="page-header">
    <h1>Blog Manager
        <?php
        if (arcGetURLData("data3") != null) {
            echo "<a href='" . arcGetModulePath() . "'><span class='fa fa-arrow-circle-left'></span></a>";
        }
        ?>
    </h1>
</div>

<?php
$page = new Blog();
if (arcGetURLData("data4") != "0") {
    $page->getByID(arcGetURLData("data4"));
}
?>
<form role="form">

    <div class="row">
        <div class="col-md-8">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Post</h3>
                </div>
                <div class="panel-body">
                    <div class="form-group">
                        <label for="title">Title</label>
                        <input type="text" class="form-control" id="title" placeholder="Title" maxlength="200" value="<?php echo $page->title; ?>">
                    </div>
                    <div class="form-group">
                        <label for="seourl">SEO Url</label>
                        <input type="text" class="form-control" id="seourl" placeholder="SEO Url" maxlength="50" value="<?php echo $page->seourl; ?>">
                    </div>
                    <div class="form-group">
                        <label for="tags">Tags</label>
                        <input type="text" class="form-control" id="tags" placeholder="Post Tags" value="<?php echo $page->tags; ?>">
                    </div>
                    <div class="form-group">
                        <label for="category">Category</label>
                        <select class="form-control" id="category">
                            <?php
                            $categories = BlogCategory::getAllCategories();
                            foreach ($categories as $category) {
                                echo "<option value=\"" . $category->id . "\"";
                                if ($category->id == $page->categoryid) {
                                    echo " selected";
                                }
                                echo ">" . $category->name . "</option>";
                            }
                            ?>
                        </select>
                    </div> 
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Image</h3>
                </div>
                <div class="panel-body">
                    <div class="form-group text-center">
                        <?php
                        echo "<img id=\"img\" style=\"cursor: pointer;\" onclick=\"$('#imageModal').modal('show');\" ";
                        if (empty($page->image)) {
                            echo "src=\"/modules/blog/images/placeholder.png\"";
                        } else {
                            echo "src=\"" . arcGetPath() . "images/blog/" . $page->image . "\"";
                        }
                        echo " alt=\"Post Image\" class=\"img-rounded\" />";
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="panel panel-default">
        <div class="panel-body">
            <div class="form-group">


                <div class="navbar-default" data-role="editor-toolbar" data-target="#editor">
                    <div class="btn-group">
                        <a class="btn dropdown-toggle" data-toggle="dropdown" title="Font"><span class="fa fa-font"></span><b class="caret"></b></a>
                        <ul class="dropdown-menu">
                        </ul>
                    </div>
                    <div class="btn-group">
                        <a class="btn dropdown-toggle" data-toggle="dropdown" title="Font Size"><span class="fa fa-text-height"></span>&nbsp;<b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <li><a data-edit="fontSize 5"><font size="5">Huge</font></a></li>
                            <li><a data-edit="fontSize 3"><font size="3">Normal</font></a></li>
                            <li><a data-edit="fontSize 1"><font size="1">Small</font></a></li>
                        </ul>
                    </div>
                    <div class="btn-group">
                        <a class="btn" data-edit="bold" title="Bold (Ctrl/Cmd+B)"><span class="fa fa-bold"></span></a>
                        <a class="btn" data-edit="italic" title="Italic (Ctrl/Cmd+I)"><span class="fa fa-italic"></span></a>
                        <a class="btn" data-edit="strikethrough" title="Strikethrough"><span class="fa fa-strikethrough"></span></a>
                        <a class="btn" data-edit="underline" title="Underline (Ctrl/Cmd+U)"><span class="fa fa-underline"></span></a>
                    </div>
                    <div class="btn-group">
                        <a class="btn" data-edit="insertunorderedlist" title="Bullet list"><span class="fa fa-list-ul"></span></a>
                        <a class="btn" data-edit="insertorderedlist" title="Number list"><span class="fa fa-list-ol"></span></a>
                        <a class="btn" data-edit="outdent" title="Reduce indent (Shift+Tab)"><span class="fa fa-outdent"></span></a>
                        <a class="btn" data-edit="indent" title="Indent (Tab)"><span class="fa fa-indent"></span></a>
                    </div>
                    <div class="btn-group">
                        <a class="btn" data-edit="justifyleft" title="Align Left (Ctrl/Cmd+L)"><span class="fa fa-align-left"></span></a>
                        <a class="btn" data-edit="justifycenter" title="Center (Ctrl/Cmd+E)"><span class="fa fa-align-center"></span></a>
                        <a class="btn" data-edit="justifyright" title="Align Right (Ctrl/Cmd+R)"><span class="fa fa-align-right"></span></a>
                        <a class="btn" data-edit="justifyfull" title="Justify (Ctrl/Cmd+J)"><span class="fa fa-align-justify"></span></a>
                    </div>
                    <div class="btn-group">
                        <a class="btn dropdown-toggle" data-toggle="dropdown" title="Hyperlink"><span class="fa fa-link"></span></a>
                        <div class="dropdown-menu input-append">
                            <input class="span2" placeholder="URL" type="text" data-edit="createLink"/>
                            <button class="btn" type="button">Add</button>
                        </div>
                        <a class="btn" data-edit="unlink" title="Remove Hyperlink"><span class="fa fa-cut"></span></a>

                    </div>

                    <div class="btn-group">
                        <a class="btn" title="Insert picture (or just drag & drop)" id="pictureBtn"><span class="fa fa-picture-o"></span></a>
                        <input type="file" data-role="magic-overlay" data-target="#pictureBtn" data-edit="insertImage" />
                    </div>
                    <div class="btn-group">
                        <a class="btn" data-edit="undo" title="Undo (Ctrl/Cmd+Z)"><span class="fa fa-undo"></span></a>
                        <a class="btn" data-edit="redo" title="Redo (Ctrl/Cmd+Y)"><span class="fa fa-repeat"></span></a>
                    </div>
                    <input type="text" data-edit="inserttext" id="voiceBtn" x-webkit-speech="">
                    <a class="btn" data-edit="html" title="Html Editor" onclick="showHtml();"><span class="fa fa-file-code-o"></span> Source</a>
                </div>
                <div id="editor"><?php echo html_entity_decode($page->content); ?></div>
            </div>
        </div>
    </div>

    <div class="text-right">

        <button type="button" class="btn btn-success" onclick="doUpdate();"><span class="fa fa-save"></span> Save</button></div>
</form>


<div class="modal fade" id="htmlModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only"><span class="fa fa-close"></span> Close</span></button>
                <h4 class="modal-title">Html Editor</h4>
            </div>
            <div class="modal-body">
                <textarea id="htmlEditor" rows="20" class="form-control"></textarea>              
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" onclick="saveHtml();">Update</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="imageModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only"><span class="fa fa-close"></span> Close</span></button>
                <h4 class="modal-title">Image Browser</h4>
            </div>
            <div class="modal-body">
                <?php
                if (!file_exists(arcGetPath(true) . "images/blog")) {
                    mkdir(arcGetPath() . "images/blog");
                }
                ?>
                <img onclick="selectImage('');" style="cursor: pointer;" src="/modules/blog/images/placeholder.png" height="150px" width="150px" class="img-rounded"/> 
                <?php
                $files = scandir(arcGetPath(true) . "images/blog");
                foreach ($files as $file) {
                    if ($file != "." && $file != "..") {
                        ?>
                        <img onclick="selectImage('<?php echo $file; ?>');" style="cursor: pointer;" src="<?php echo arcGetPath(); ?>images/blog/<?php echo $file; ?>" height="150px" width="150px" class="img-rounded"/> 
                        <?php
                    }
                }
                ?>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<script>
    function selectImage(image) {
        ajax.send('POST', {action: 'setimage', id: '<?php echo $page->id; ?>', image: image}, '<?php echo arcGetDispatch(); ?>', null, true);
        var img = document.getElementById('img');
        if (image == '') {
            img.src = '/modules/blog/images/placeholder.png';
        } else {
            img.src = '/images/blog/' + image;
        }
        $('#imageModal').modal('hide');
    }
    function showHtml() {
        var html = document.getElementById('htmlEditor');
        var txt = $('#editor').html();
        html.value = txt;
        $('#htmlModal').modal('show');
    }

    function saveHtml() {
        var html = document.getElementById('htmlEditor');
        $('#editor').html(html.value);
        $('#editor').cleanHtml();
        $('#htmlModal').modal('hide');
    }

    function doUpdate() {
        var txt = $('#editor').html();
        ajax.send('POST', {action: 'savepost', categoryid: '#category', tags: '#tags', editor: txt, seourl: '#seourl', title: '#title', id: '<?php echo $page->id; ?>', poster: '<?php echo arcGetUser()->id; ?>'}, '<?php arcGetDispatch(); ?>', updateStatus, true);
    }

    $(function () {
        function initToolbarBootstrapBindings() {
            var fonts = ['Serif', 'Sans', 'Arial', 'Arial Black', 'Courier',
                'Courier New', 'Comic Sans MS', 'Helvetica', 'Impact', 'Lucida Grande', 'Lucida Sans', 'Tahoma', 'Times',
                'Times New Roman', 'Verdana'],
                    fontTarget = $('[title=Font]').siblings('.dropdown-menu');
            $.each(fonts, function (idx, fontName) {
                fontTarget.append($('<li><a data-edit="fontName ' + fontName + '" style="font-family:\'' + fontName + '\'">' + fontName + '</a></li>'));
            });
            $('a[title]').tooltip({container: 'body'});
            $('.dropdown-menu input').click(function () {
                return false;
            })
                    .change(function () {
                        $(this).parent('.dropdown-menu').siblings('.dropdown-toggle').dropdown('toggle');
                    })
                    .keydown('esc', function () {
                        this.value = '';
                        $(this).change();
                    });

            $('[data-role=magic-overlay]').each(function () {
                var overlay = $(this), target = $(overlay.data('target'));
                overlay.css('opacity', 0).css('position', 'absolute').offset(target.offset()).width(target.outerWidth()).height(target.outerHeight());
            });
            if ("onwebkitspeechchange"  in document.createElement("input")) {
                var editorOffset = $('#editor').offset();
                $('#voiceBtn').css('position', 'absolute').offset({top: editorOffset.top, left: editorOffset.left + $('#editor').innerWidth() - 35});
            } else {
                $('#voiceBtn').hide();
            }
        }
        ;
        function showErrorAlert(reason, detail) {
            var msg = '';
            if (reason === 'unsupported-file-type') {
                msg = "Unsupported format " + detail;
            }
            else {
                console.log("error uploading file", reason, detail);
            }
            $('<div class="alert"> <button type="button" class="close" data-dismiss="alert">&times;</button>' +
                    '<strong>File upload error</strong> ' + msg + ' </div>').prependTo('#alerts');
        }
        ;
        initToolbarBootstrapBindings();
        $('#editor').wysiwyg({fileUploadError: showErrorAlert});
        window.prettyPrint && prettyPrint();
    });
</script>