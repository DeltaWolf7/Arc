<div class="page-header">
    <h1>Page Management
        <?php
        if ($GLOBALS["arc"]->getURLData("data3") != null) {
            echo "<a href='" . $GLOBALS["arc"]->getModulePath() . "'><span class='fa fa-arrow-circle-left'></span></a>";
        }
        ?>
    </h1>
</div>

<?php
if (empty($GLOBALS["arc"]->getURLData("data2"))) {
    ?>
    <div class="panel panel-default">
        <div class="panel-body">
            <table class="table table-striped">
                <tr><th>SEO Url</th><th>Title</th><th class="text-right"><a href="<?php echo $GLOBALS["arc"]->getModulePath() . "edit/0"; ?>"><span class="fa fa-plus"></span> New Page</a></th></tr>
                <?php
                $pages = Page::getAllPages();
                foreach ($pages as $page) {
                    echo "<tr><td>" . $page->seourl . "</td><td>" . $page->title . "</td><td class='text-right'><a href='" . $GLOBALS["arc"]->getModulePath() . "edit/" . $page->id . "'><span class='fa fa-edit'></span>&nbsp;Edit</a>"
                    . "&nbsp;<a href='" . $GLOBALS["arc"]->getModulePath() . "remove/" . $page->id . "'><span class='fa fa-remove'></span>&nbsp;Remove</a></td></tr>";
                }
                ?>
            </table>
        </div>
    </div>
    <?php
} elseif ($GLOBALS["arc"]->getURLData("data2") == "edit") {

    $page = new Page();
    if ($GLOBALS["arc"]->getURLData("data3") != "0") {
        $page->getByID($GLOBALS["arc"]->getURLData("data3"));
    }
    ?>
    <form role="form">

        <div class="row">
            <div class="col-md-6">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Page Details</h3>
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
                        <?php if ($page->id != 0) { ?>
                            <div class="form-group">
                                <br />
                                <div class="row">
                                    <div class="col-md-6 text-center">
                                        <?php
                                        $permissions = $page->getPermissions();
                                        echo "<br />This page belongs to " . count($permissions) . " group";
                                        if (count($permissions) > 1) {
                                            echo "s";
                                        }
                                        echo "."
                                        ?>
                                    </div>
                                    <div class="col-md-6 text-right">
                                        <button type="button" class="btn btn-default" onclick="showPermissions();">Edit Page Permissions</button>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">META Details</h3>
                    </div>
                    <div class="panel-body">
                        <div class="form-group">
                            <label for="metatitle">META Title</label>
                            <input type="text" class="form-control" id="metatitle" maxlength="55" placeholder="META Title" value="<?php echo $page->metatitle; ?>">
                        </div>
                        <div class="form-group">
                            <label for="metadescription">META Description</label>
                            <input type="text" class="form-control" id="metadescription" maxlength="160" placeholder="META Description" value="<?php echo $page->metadescription; ?>">
                        </div>
                        <div class="form-group">
                            <label for="metakeywords">META Keywords</label>
                            <input type="text" class="form-control" id="metakeywords" maxlength="69" placeholder="META Keywords" value="<?php echo $page->metakeywords; ?>">
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
                        <a class="btn" data-edit="html" title="Html Editor" onclick="showHtml();"><span class="fa fa-html5"></span></a>
                    </div>
                    <div id="editor"><?php echo html_entity_decode($page->content); ?></div>
                </div>
            </div>
        </div>

        <div class="text-right">

            <button type="button" class="btn btn-default" onclick="doUpdate();">Update</button></div>
    </form>


    <div class="modal fade" id="htmlModal" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
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

    <div class="modal fade" id="permissonsModal" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <h4 class="modal-title">Page Permissions</h4>
                </div>
                <div class="modal-body">
                    <table class="table table-striped">
                        <tr><th>Group</th><th>&nbsp;</th></tr>
                        <?php
                        $permissions = $page->getPermissions();
                        foreach ($permissions as $permission) {
                            $group = $permission->getGroup();
                            echo "<tr><td>" . $group->name . "</td><td class='text-right'><a href='" . $GLOBALS["arc"]->getModulePath() . "permission/remove/" . $permission->id . "/" . $page->id . "'><span class='fa fa-remove'></span> Remove</a>";
                            echo "</td></tr>";
                        }
                        ?>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" onclick="window.location = '<?php echo $GLOBALS["arc"]->getModulePath() . "edit/" . $page->id; ?>'">Refresh</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal" onclick="addPermission();">New Permission</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="addpermissonsModal" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <h4 class="modal-title">Add New Page Permission</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="pagegroup">Group</label>
                        <select id="pagegroup" class="form-control">
                            <?php
                            $groups = UserGroup::getAllGroups();
                            foreach ($groups as $group) {
                                echo "<option value='" . $group->id . "'>" . $group->name . "</option>";
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal" onclick="ajax.send('POST', {action: 'addpermission', pageid: '<?php echo $page->id; ?>', groupid: '#pagegroup'}, '<?php $GLOBALS["arc"]->getDispatch(); ?>', null, true);">Add To Group</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <?php
} elseif ($GLOBALS["arc"]->getURLData("data2") == "remove") {
    $page = new Page();
    $page->delete($page->id);
    $GLOBALS["arc"]->redirect($GLOBALS["arc"]->getModulePath());
} elseif ($GLOBALS["arc"]->getURLData("data2") == "permission" && $GLOBALS["arc"]->getURLData("data3") == "remove") {
    $permission = new UserPermission();
    $permission->delete($GLOBALS["arc"]->getURLData("data4"));
    $GLOBALS["arc"]->redirect($GLOBALS["arc"]->getModulePath() . "edit/" . $GLOBALS["arc"]->getURLData("data5"));
} elseif ($GLOBALS["arc"]->getURLData("data2") == "permission" && $GLOBALS["arc"]->getURLData("data3") == "add") {
    $permission = new UserPermission();
    $permission->delete($GLOBALS["arc"]->getURLData("data4"));
    $GLOBALS["arc"]->redirect($GLOBALS["arc"]->getModulePath() . "edit/" . $GLOBALS["arc"]->getURLData("data5"));
}
?>



<script>
    function addPermission() {
        $('#addpermissonsModal').modal('show');
    }

    function showPermissions() {
        $('#permissonsModal').modal('show');
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
        ajax.send('POST', {action: 'savepage', metatitle: '#metatitle', metadescription: '#metadescription', metakeywords: '#metakeywords', editor: txt, seourl: '#seourl', title: '#title'}, '<?php $GLOBALS["arc"]->getDispatch(); ?>', updateStatus, true);
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