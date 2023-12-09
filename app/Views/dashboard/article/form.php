<?= $this->extend('dashboard/layouts/app'); ?>

<?= $this->section('style') ?>
  <!-- Select2 -->
  <link rel="stylesheet" href="/template/adminLTE/plugins/select2/css/select2meta.css">
<?= $this->endSection(); ?>

<?= $this->section('content'); ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Create Article</h1>
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <section class="content">
      <div class="container-fluid">
        <div class="row mb-3">
          <div class="col-lg-8">
            <div class="card">
              <div class="card-body">
                <div class="row mb-3">
                  <div class="col-12">
                    <label class="fw-medium text-muted">Judul</label>
                    <input id="inpjudul" type="text" class="form-control" maxlength="100" name="judul" />
                  </div>
                  <!-- end col -->
                </div>
                <!-- end row -->
                <div class="row mb-3" >
                  <div class="col-md-12 mb-3 text-center">
                    <img src="" alt="" class="img-fluid">
                  </div>
                  <div class="col-md-12">
                    <label class="fw-medium text-muted">Poster</label>
                    <input class="form-control" type="file" onchange="showImg(this)" name="inpupload" id="inpupload" accept="image/png, image/jpeg">
                    <small>&nbsp;</small>
                  </div>
                  <!-- end col -->
                </div>
                <!-- end row -->
                <div class="row mb-3">
                  <div class="col-12">
                    <textarea name="konten" id="body_konten"></textarea>
                  </div>
                </div>
                <!-- end row -->
              </div>
              <!-- end card-body -->
            </div>
            <!-- end card -->
          </div>
          <!-- end col -->
          <div class="col-lg-4">
            <div class="card">
              <div class="card-body">
                <div class="row mb-3">
                  <div class="col-12">
                    <label class="mb-1 fw-medium text-muted">Rubrik</label>
                    <select class="form-control select2" data-placeholder="Pilih kategori" style="width: 100%" id="kategori">
                      <?php if(sizeof($category)) : ?>
                          <?php foreach($category as $item) : ?>
                            <option value="<?= $item['id_kategori'] ?>"><?= $item['nama_kategori'] ?></option>
                          <?php endforeach ?>
                      <?php else : ?>
                        <option value="">belum ada kategori</option>
                      <?php endif ?>
                    </select>
                  </div>
                </div>
                <div class="row mb-3">
                  <div class="col-12">
                    <label class="mb-1 fw-medium text-muted">Deskripsi</label>
                    <textarea id="inpdeskripsi" class="form-control" maxlength="225" rows="3"></textarea>
                  </div>
                  <!-- end col -->
                </div>
                <!-- end row -->
                <div class="row mb-3">
                  <div class="col-12">
                    <label class="mb-1 fw-medium text-muted">Kata Kunci &ltmeta keyword&gt</label>
                    <textarea id="meta_keyword" class="form-control" maxlength="225" rows="3"></textarea>
                  </div>
                  <!-- end col -->
                </div>
                <!-- end row -->

                <div class="row mb-3">
                  <div class="col-12 mb-1">
                    <label class="mb-1 fw-medium text-muted">Tag</label>
                    <select id="select-meta" multiple="multiple" data-placeholder="Pilih tag" style="width: 100%">
                      <?php if(sizeof($tags)): ?>
                        <?php foreach($tags as $tag): ?>
                          <option value="<?= $tag['id_meta'] ?>"><?= $tag['meta'] ?></option>
                        <?php endforeach; ?>
                      <?php endif; ?>
                    </select>
                  </div>
                </div>
                <!-- end row -->

              </div>
              <!-- end card-body -->
            </div>
            <!-- end card -->

            <div class="card mt-5">
              <div class="card-body">
                <div class="row">
                  <div class="col-12 text-center mb-3">
                      <!-- <button type="button" onclick="tambahclick()" class="btn btn-danger waves-effect waves-light">
                        <i class="fas fa-plus"></i>
                      </button> -->
                      <button type="button" onclick="simpanclick()" class="btn btn-success waves-effect waves-light" title="Save">
                        <i class="fas fa-save"></i>
                      </button>
                      <!-- <button type="button" class="btn btn-primary waves-effect waves-light">
                        <i class="fas fa-eye"></i>
                      </button>
                      <button id="btnrefresh" onclick="refreshclick()" type="button" class="btn btn-success waves-effect waves-light" >
                        <i class="fas fa-retweet"></i>
                      </button> -->
                      <button id="btnpublish" onclick="publishclick()" type="button" class="btn btn-success waves-effect waves-light" title="Publish">
                        <i class="far fa-paper-plane"></i>
                      </button>
                      <!-- <button id="dbtnaddto" type="button" onclick="addtoclick()" class="btn btn-secondary">
                        <i class="fas fa-check"></i>
                      </button> -->
                  </div>
                  <div class="col-12 text-center mt-3" >
                      <label class="mb-1 fw-medium text-muted">Publish pada tanggal</label>
                      <input type="date" class="form-control mb-1" name="publish_date" id="publish-date">
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- end col -->
        </div>
        <!-- end row -->

        <div class="row">
          <div class="col-lg-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Related Article</h3>
                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-toggle="modal" data-target="#tambah-related-article" id="load-related-article"><i class="fas fa-plus"></i></button>
                  <!-- <button type="button" class="btn btn-tool"><i class="fas fa-sync-alt"></i></button>   -->
                </div>
              </div>
              <div class="card-body">
                <table class="table table-bordered table-hover">
                  <thead>
                    <tr>
                      <th scope="row" style="width: 50px;">#</th>
                      <th scope="row">Judul</th>
                      <th scope="row" style="width: 50px;"></th>
                    </tr>
                  </thead>
                  <tbody id="backlink-table"></tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
        <!-- end row -->

      </div>
      <!-- container -->
    </section>
    <!-- content -->
  </div>
  <!-- /.content-wrapper -->


  <div class="modal fade" id="tambah-related-article">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Related article check</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="row col-lg-12 mb-3">
            <div class="container-fluid">
              <div class="row">
                <div class="col-lg-4">
                  <div class="input-group">
                    <input type="text" class="form-control" id="search-judul-related-article-check" placeholder="Cari judul" data-search="">
                    <button type="button" class="btn btn-default d-none" id="reload-related-article-check"><i class="fas fa-sync-alt"></i></button>
                  </div>
                </div>
                <!-- <div class="col-lg-4">
                  <div class="form-group">
                    <select name="" id="" class="form-control">
                      <option value="1">1</option>
                    </select>
                  </div>
                </div>
                <div class="col-lg-4">
                  <div class="form-group">
                    <div class="custom-control custom-checkbox">
                      <input class="custom-control-input" type="checkbox" id="author-check" value="option1">
                      <label for="author-check" class="custom-control-label">Semua author</label>
                    </div>
                  </div>
                </div> -->
              </div>
            </div>
          </div>
          <div class="row col-lg-12">
            <div class="container-fluid">
              <table class="table table-bordered table-hover">
                <thead>
                  <tr>
                    <th scope="row" style="width: 50px;">#</th>
                    <th scope="row">Judul</th>
                    <th scope="row" style="width: 50px;"></th>
                  </tr>
                </thead>
                <tbody id="backlink-table-check"></tbody>
              </table>
            </div>
          </div>
        </div>
        <div class="modal-footer justify-content-between">
          <div>
            <ul class="pagination" id="pagination-related-article-check"></ul>
          </div>
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  <!-- /.modal -->


<?= $this->endSection(); ?>

<?= $this->section('script') ?>
  <!-- Select2 -->
  <script src="/template/adminLTE/plugins/select2/js/select2.full.min.js"></script>
  <script>
    $(function () {
        showEditorTinymce('textarea#body_konten');
        $('#kategori').select2();

        $('#select-meta').select2({
          tags: true,
          createTag: function (params) {
            var term = $.trim(params.term);
            if (term === "") {
              return null;
            }
            return {
              id: term,
              text: term,
              newTag: true
            };

          }
        }).on('select2:select', function (e) {
          // Check if the selected option is a new tag
          if (e.params.data.newTag) {
            // Make an AJAX request to create and store the new tag
            $.ajax({
              url: '<?= url_to('preference.tag.store') ?>', // The CI4 route for storing tags
              type: 'POST',
              data: { tag: e.params.data.text }, // Use the text of the new tag
              dataType: 'json',
              success: function (response) {
                // Set the value of the select element to the ID returned by the server
                $(`#select-meta option[value="${response.meta}"]`).val(response.id_meta);
              },
              error: function (xhr, status, error) {
                console.error('Error: ' + error);
              }
            });
          }
        });

        const jsonDataArticle = [];
        $.ajax({
            url: '<?= url_to('article.backlink') ?>',
            type: 'POST',
            dataType: 'JSON',
            success: function (response) {
              for (let i = 0; i < response.length; i++) {
                jsonDataArticle.push({judul: response[i].judul, id_judul: response[i].id_judul});
              }
            },
            error: function (xhr, status, error) {
              makeToast('bg-danger', `Error: ${error}`);
            }
          });

        $('#load-related-article').click(() => {
          if ($('#backlink-table-check').children('tr').length === 0) {
            generateDataRelatedArticle();
          }
        });
        $('#search-judul-related-article-check').on('keyup', function(e){
          if (e.key === "Enter") {       
            let value = $(this).val();
            $(this).attr('data-search', value);
            generateDataRelatedArticle(1, value);
          }
        });


        $('#pagination-related-article-check').on('click', 'a.page-link', function () {
            let clickedButton = $(this);
            let search = $('#search-judul-related-article-check').attr('data-search');
            let page = clickedButton.attr('data-page');
            generateDataRelatedArticle(page, search);
        });
        $('#reload-related-article-check').on('click', function() {
          if (!$(this).hasClass('d-none')) {
            $(this).toggleClass('d-none');
          }
          $('#search-judul-related-article-check').attr('data-search', '');
          $('#search-judul-related-article-check').val('');
          generateDataRelatedArticle();
        });

        $('#backlink-table-check').on('click', 'button.button-tambah-related-article', function () {
          let clickedButton = $(this);
          let listRelatedArticle = $('#backlink-table');
          let articleJudul = clickedButton.attr('data-judul');
          let articleId = clickedButton.attr('data-id_judul');
          if (clickedButton.hasClass('button-tambah-related-article')) {
            let count = listRelatedArticle.children('tr').length;
            setTimeout(() => {              
              listRelatedArticle.append(`
                      <tr>
                          <td>${count + 1}</td>
                          <td class="title-article">${articleJudul}</td>
                          <td>
                              <button type="button" class="btn btn-default btn-sm button-delete-related-article" data-judul="${articleJudul}" data-id_judul="${articleId}" title="hapus dari related article">
                              <i class="fas fa-trash"></i>
                            </button>
                          </td>
                      </tr>
              `);
            }, 1000);
            removeItemById(articleId);
            clickedButton.parent().parent().animate(
              {
                right: '-100%', // Adjust the distance as needed
                opacity: 0,
              },
              1000, // Duration of the animation in milliseconds
              function () {
                // Callback function to remove the element from the DOM
                $(this).remove();
                let pageActive = $('#pagination-related-article-check').find('li.page-item.active').find('a.page-link').attr('data-page');
                generateDataRelatedArticle(pageActive);
              }
            );
          }
        });

        $('#backlink-table').on('click', 'button.button-delete-related-article', function () {
          let clickedButton = $(this);
          let articleJudul = clickedButton.attr('data-judul');
          let articleId = clickedButton.attr('data-id_judul');
          if (clickedButton.hasClass('button-delete-related-article')) {
            jsonDataArticle.unshift({judul: articleJudul, id_judul: articleId});
            clickedButton.parent().parent().animate(
              {
                right: '-100%', // Adjust the distance as needed
                opacity: 0,
              },
              1000, // Duration of the animation in milliseconds
              function () {
                // Callback function to remove the element from the DOM
                $(this).remove();
                let backlinkTableChild = $('#backlink-table').find('button.button-delete-related-article');
                let dataBacklinkTable = [];
                for( b of backlinkTableChild ){
                  let childJudul = $(b).attr('data-judul');
                  let childID = $(b).attr('data-id_judul');
                  dataBacklinkTable.push({judul: childJudul, id_judul: childID});
                }
                if (dataBacklinkTable.length !== 0) {
                  setTimeout(() => {
                    $('#backlink-table').empty();
                    dataBacklinkTable.forEach(({judul,id}, i) => {
                      $('#backlink-table').append(`
                        <tr>
                            <td>${i + 1}</td>
                            <td class="title-article">${judul}</td>
                            <td>
                                <button type="button" class="btn btn-default btn-sm button-delete-related-article" data-judul="${judul}" data-id_judul="${id}" title="hapus dari related article">
                                <i class="fas fa-trash"></i>
                              </button>
                            </td>
                        </tr>
                      `);
                    });
                  }, 500);
                }
                generateDataRelatedArticle(1, $('#search-judul-related-article-check').attr('data-search'));
              }
            );
          }
        });

        function generateDataRelatedArticle(page = 1, search = null) {
          let articlesPerPage = 10;
          let startIndex = (page - 1) * articlesPerPage;
          let endIndex = startIndex + articlesPerPage;
          let $articleTable = $('#backlink-table-check');
          $articleTable.empty();

          if (search == null || search == '') {
            for (let i = startIndex; i < endIndex && i < jsonDataArticle.length; i++) {
            
              $articleTable.append(`
                  <tr>
                      <td>${i + 1}</td>
                      <td class="title-article">${jsonDataArticle[i].judul}</td>
                      <td>
                          <button type="button" class="btn btn-default btn-sm button-tambah-related-article" data-judul="${jsonDataArticle[i].judul}" data-id_judul="${jsonDataArticle[i].id_judul}" title="masukkan ke related article">
                              <i class="fas fa-plus"></i>
                          </button>
                      </td>
                  </tr>
              `);
            }

            let totalPages = Math.ceil(jsonDataArticle.length / articlesPerPage);
            generatePagerPagination(totalPages, page);

            if (!$('#reload-related-article-check').hasClass('d-none')) {
                $('#reload-related-article-check').toggleClass('d-none');
              }
          } else {
            let filteredData = jsonDataArticle.filter(function (item) {
              return item.judul.toLowerCase().includes(search.toLowerCase());
            });
            if (filteredData.length === 0) {
              $articleTable.append('<tr><td colspan="3" class="text-center">Judul tidak ditemukan</td></tr>');
              if ($('#reload-related-article-check').hasClass('d-none')) {
                $('#reload-related-article-check').toggleClass('d-none');
              }
            } else {
              for (let i = startIndex; i < endIndex && i < filteredData.length;i++) {
                $articleTable.append(`
                    <tr>
                        <td>${i + 1}</td>
                        <td class="title-article">${filteredData[i].judul}</td>
                        <td>
                            <button type="button" class="btn btn-default btn-sm button-tambah-related-article" data-judul="${filteredData[i].judul}" data-id_judul="${filteredData[i].id_judul}" title="masukkan ke related article">
                                <i class="fas fa-plus"></i>
                            </button>
                        </td>
                    </tr>
                `);
                
              }
              
              let totalPages = Math.ceil(filteredData.length / articlesPerPage);
              generatePagerPagination(totalPages, page);

              if (!$('#reload-related-article-check').hasClass('d-none')) {
                $('#reload-related-article-check').toggleClass('d-none');
              }
            }

          }          
        }
        // Function to remove an item based on its slug
        function removeItemById(id) {
            for (let i = 0; i < jsonDataArticle.length; i++) {
                if (jsonDataArticle[i].id_judul === id) {
                    jsonDataArticle.splice(i, 1); // Remove the item at index i
                    break; // Exit the loop
                }
            }
        }

        // function generate pagination page 
        function generatePagerPagination(totalPages = 1, page = 1){

          let $pagination = $('#pagination-related-article-check');
          $pagination.empty();

          let startPagination = 1;
          let endPagination = totalPages;


          if (totalPages > 10) {
            if (page <= 6) {
              startPagination = 1;
              endPagination = 10;
            } else if (page >= totalPages - 5) {
              startPagination = totalPages - 9;
              endPagination = totalPages;
            } else {
              startPagination = page - 5;
              endPagination = parseInt(page) + 4;
            }
          }

          for (let i = startPagination; i <= endPagination; i++) {
              $pagination.append(`<li class="page-item ${i == page ? 'active' : ''}"><a class="page-link" href="javascript:void(0)" data-page="${i}">${i}</a></li>`);
          }
        }
    });


    function showImg(img)
    {
        let imagePre = $(img).closest(".row").find(".img-fluid");

        let oFReader = new FileReader();
        oFReader.readAsDataURL(img.files[0]);
    
        oFReader.onload = function(oFREvent)
        {
            imagePre.attr('src', oFREvent.target.result);
            imagePre.css('height', '250px');
        }
    }

    function simpanclick(){
      let judul= $("#inpjudul").val();
      let poster= $("#inpupload")[0].files[0];
      let body_konten= tinymce.activeEditor.getContent();
      let deskripsi= $("#inpdeskripsi").val();
      let meta_keyword = $('#meta_keyword').val();
      let kategori = $('#kategori').val();
      let date = $('#publish-date').val();
      let meta = $('#select-meta').val();
      let arrayDataRelatedTable = $('#backlink-table').find('button.button-delete-related-article');
      let dataRelatedArticle = [];
      for (let i = 0; i < arrayDataRelatedTable.length; i++) {
        let id_judul = $(arrayDataRelatedTable[i]).attr('data-id_judul');
        dataRelatedArticle.push(id_judul);
      }

      let uploadStatus = 1;
      if(judul==""){
        makeToast("bg-danger", "Judul belum terisi!!!");
        uploadStatus = 0;
      }
      else if(poster == null){
        makeToast("bg-danger", "poster harus di Isi");
        uploadStatus=0;
      }
      else if(body_konten==""){
        makeToast("bg-danger", "konten harus di Isi");
        uploadStatus=0;
      }
      else if(deskripsi==""){
        makeToast("bg-danger", "Deskripsi belum terisi!!!");
        uploadStatus = 0;
      }
      else if(kategori=="0"){
        uploadStatus = 0;
        makeToast("bg-danger", "Kategori belum ditentukan!");
      }
      else if(meta.length == 0){
        uploadStatus = 0;
        makeToast("bg-danger", "Tag belum terisi")
      }

      if(uploadStatus !== 1 ){}
      else {
        var formData = new FormData();
        formData.append('judul', judul);
        formData.append('meta_keyword', meta_keyword);
        formData.append('poster', poster);
        formData.append('kategori', kategori);
        formData.append('konten', body_konten);
        formData.append('deskripsi', deskripsi);
        formData.append('meta', JSON.stringify(meta));
        formData.append('date', date);
        formData.append('backlink', JSON.stringify(dataRelatedArticle));

        $.ajax({
            type: 'POST',
            url: "<?= url_to('article.store') ?>",
            data: formData,
            contentType: false,
            processData: false,
            success: function(response) {
              makeToast(response.bg, response.message);
              if (response.bg == 'bg-success') {if(confirm('Pindah ke list artikel?')){location.href= "<?= url_to('article.index') ?>"}else {location.href = `<?= url_to('article.form') ?>/edit/${response.slug}`}} 
            },
            error: function(xhr, status, error) {
              makeToast('bg-danger', xhr.responseText);
            }
        });
      }

    }

    function publishclick()
    {
      let judul= $("#inpjudul").val();
      let poster= $("#inpupload")[0].files[0];
      let body_konten= tinymce.activeEditor.getContent();
      let deskripsi= $("#inpdeskripsi").val();
      let meta_keyword = $('#meta_keyword').val();
      let kategori = $('#kategori').val();
      let meta = $('#select-meta').val();
      let arrayDataRelatedTable = $('#backlink-table').find('button.button-delete-related-article');
      let dataRelatedArticle = [];
      for (let i = 0; i < arrayDataRelatedTable.length; i++) {
        let id_judul = $(arrayDataRelatedTable[i]).attr('data-id_judul');
        dataRelatedArticle.push(id_judul);
      }

      let uploadStatus = 1;
      if(judul==""){
        makeToast("bg-danger", "Judul belum terisi!!!");
        uploadStatus = 0;
      }
      else if(poster == null){
        makeToast("bg-danger", "poster harus di Isi");
        uploadStatus=0;
      }
      else if(body_konten==""){
        makeToast("bg-danger", "konten harus di Isi");
        uploadStatus=0;
      }
      else if(deskripsi==""){
        makeToast("bg-danger", "Deskripsi belum terisi!!!");
        uploadStatus = 0;
      }
      else if(kategori=="0"){
        uploadStatus = 0;
        makeToast("bg-danger", "Kategori belum ditentukan!");
      }
      else if(meta.length == 0){
        uploadStatus = 0;
        makeToast("bg-danger", "Tag belum terisi")
      }

      if(uploadStatus !== 1 ){}
      else {
        var formData = new FormData();
        formData.append('judul', judul);
        formData.append('meta_keyword', meta_keyword);
        formData.append('poster', poster);
        formData.append('kategori', kategori);
        formData.append('konten', body_konten);
        formData.append('deskripsi', deskripsi);
        formData.append('meta', JSON.stringify(meta));
        formData.append('backlink', JSON.stringify(dataRelatedArticle));

        $.ajax({
            type: 'POST',
            url: "<?= url_to('article.publish') ?>",
            data: formData,
            contentType: false,
            processData: false,
            success: function(response) {
              makeToast(response.bg, response.message);
              if (response.bg == 'bg-success') {if(confirm('Pindah ke list artikel?')){location.href= "<?= url_to('article.index') ?>"} else {location.href = `<?= url_to('article.form') ?>/edit/${response.slug}`}}
            },
            error: function(xhr, status, error) {
              makeToast('bg-danger', xhr.responseText);
            }
        });
      }
    }
  </script>
<?= $this->endSection() ?>