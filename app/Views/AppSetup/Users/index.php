<?= $this->extend('Template/layout'); ?>

<?= $this->section('content'); ?>

<main class="app-main">
    <div class="app-content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h3 class="mb-0"><?= $title; ?></h3>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item active"><a href="<?= base_url() . 'dashboard' ?>" onclick="loading()">Dashboard</a></li>
                        <li class="breadcrumb-item active">App Setup</li>
                        <li class="breadcrumb-item active">User Mangement</li>
                        <li class="breadcrumb-item active">List of Users</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="app-content">
        <div class="container-fluid">
            <div class="row g-2">
                <div class="col-12">
                    <div class="btn-group" role="group" aria-label="tooltip">
                        <button type="button" id="btnAdd" class="btn shadow-none rounded-0 btn-light border-0" title="New">
                            New
                        </button>
                        <button type="button" id="btnFilter" class="btn shadow-none rounded-0 btn-light border-0" title="Filter">
                            Filter
                        </button>
                        <button type="button" id="btnRefresh" class="btn shadow-none rounded-0 btn-light border-0" title="Refresh">
                            Refresh
                        </button>
                        <button type="button" id="btnExport" class="btn shadow-none rounded-0 btn-light border-0" title="Export">
                            Export
                        </button>
                        <button type="button" id="btnDelete" class="btn shadow-none rounded-0 btn-light border-0" title="Delete Selected">
                            Delete
                        </button>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card rounded-0">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-hover" id="dataTable">
                                    <thead>
                                        <tr>
                                            <th class="text-center fw-bolder align-middle bg-secondary-subtle">
                                                <input type="checkbox" id="selectAll" class="form-check-input rounded-0 border-1 border-primary">
                                            </th>
                                            <th class="text-center fw-bolder align-middle bg-secondary-subtle">Username</th>
                                            <th class="text-center fw-bolder align-middle bg-secondary-subtle">Full Name</th>
                                            <th class="text-center fw-bolder align-middle bg-secondary-subtle">Email Address</th>
                                            <th class="text-center fw-bolder align-middle bg-secondary-subtle">Phone Number</th>
                                            <th class="text-center fw-bolder align-middle bg-secondary-subtle">User Status</th>
                                            <th class="text-center fw-bolder align-middle bg-secondary-subtle">User Level</th>
                                            <th class="text-center fw-bolder align-middle bg-secondary-subtle">Remark</th>
                                            <th class="text-center fw-bolder align-middle bg-secondary-subtle">Last Login</th>
                                            <th class="text-center fw-bolder align-middle bg-secondary-subtle">Login From</th>
                                            <th class="text-center fw-bolder align-middle bg-secondary-subtle">#</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
<?= $this->endSection(); ?>