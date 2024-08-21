<?php if (!defined('X')) die('Deny Access');?>

<!-- Ana İçerik -->
<div class="container table-container">
    <div class="row">
        <div class="d-flex flex-grow-1 justify-content-center align-items-center">

        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title mb-4">Online Kullanıcılar
                    <a id="getOnlines" href="javascript:;" title="Yenile" class="text-end float-end"><i class="fa-solid fa-rotate"></i></a>
                    </h4>
                    <div id="loading" class="loading">
                        <i class="fa-solid fa-spinner fa-spin"></i> Yükleniyor...
                    </div>
                    <table class="table table-sm table-hover" id="data-table" style="display: none;">
                        <thead class="bg-light">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Kullanıcı</th>
                            <th scope="col">Nerede</th>
                            <th scope="col">Son İşlem</th>
                        </tr>
                        </thead>
                        <tbody id="onlines">
                        </tbody>
                    </table>
                    <div id="no-data" style="display: none;">
                        <p>Veri yok. Kayıtlı veri bulunamadı.</p>
                    </div>

                </div>
            </div>
        </div>
    </div>
    </div>
</div>
