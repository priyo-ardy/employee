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
                        <li class="breadcrumb-item active"><a href="<?= base_url() . 'dashboard' ?>"
                                onclick="loading()">Dashboard</a></li>
                        <li class="breadcrumb-item active">App Setup</li>
                        <li class="breadcrumb-item active">User Mangement</li>
                        <li class="breadcrumb-item active">List of Users</li>
                        <li class="breadcrumb-item active">Crate New User</li>
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
                        <button type="button" id="btnSave" class="btn shadow-none rounded-0 btn-light border-0"
                            data-bs-toggle="tooltip" data-bs-placement="top" title="Save">
                            Save
                        </button>
                        <button type="button" id="btnCancel" class="btn shadow-none rounded-0 btn-light border-0"
                            data-bs-toggle="tooltip" data-bs-placement="top" title="Cancel">
                            Cancel
                        </button>
                        <button type="button" id="btnClose" class="btn shadow-none rounded-0 btn-light border-0"
                            data-bs-toggle="tooltip" data-bs-placement="top" title="Close">
                            Close
                        </button>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <form id="formData">
                        <div class="card rounded-0">
                            <div class="card-body">
                                <div class="row g-2 mb-3">
                                    <div class="form-group col-xl-3 col-lg-3 col-md-6 col-sm-12 mb-3 clearfix">
                                        <label class="form-label" for="data_username">Username <strong
                                                class="text-danger">*</strong></label>
                                        <select name="data_username" id="data_username"
                                            class="form-control select2 select2bs5" required>
                                            <option value="">-- Select Employee --</option>
                                            <?php foreach ($karyawan as $k): ?>
                                                <option value="<?= $k->NIK ?>"><?= $k->NIK ?> - <?= $k->nama_karyawan ?>
                                                </option>
                                            <?php endforeach; ?>
                                        </select>
                                        <div class="invalid-feedback"></div>
                                    </div>
                                    <div class="form-group col-xl-3 col-lg-3 col-md-6 col-sm-12 mb-3 clearfix">
                                        <label class="form-label" for="data_fullname">Full Name <strong
                                                class="text-danger">*</strong></label>
                                        <input type="text" name="data_fullname" id="data_fullname"
                                            class="form-control rounded-0 bg-secondary-subtle" placeholder="Full Name" maxlength="150"
                                            required autocomplete="off" readonly>
                                        <div class="invalid-feedback"></div>
                                    </div>
                                    <div class="form-group col-xl-3 col-lg-3 col-md-6 col-sm-12 mb-3 clearfix">
                                        <label class="form-label" for="data_email">Email Address <strong
                                                class="text-danger">*</strong></label>
                                        <input type="email" name="data_email" id="data_email"
                                            class="form-control rounded-0" placeholder="Email Address" maxlength="150"
                                            required autocomplete="off">
                                        <div class="invalid-feedback"></div>
                                    </div>
                                    <div class="form-group col-xl-3 col-lg-3 col-md-6 col-sm-12 mb-3 clearfix">
                                        <label class="form-label" for="data_phone">Phone Number <strong
                                                class="text-danger">*</strong></label>
                                        <input type="number" name="data_phone" id="data_phone"
                                            class="form-control rounded-0" placeholder="Phone Number" maxlength="20"
                                            required autocomplete="off">
                                        <div class="invalid-feedback"></div>
                                    </div>
                                    <div class="form-group col-xl-3 col-lg-3 col-md-6 col-sm-12 mb-3 clearfix">
                                        <label class="form-label" for="data_level">User Level <strong
                                                class="text-danger">*</strong></label>
                                        <select name="data_level" id="data_level"
                                            class="form-control select2 select2bs5" required>
                                            <option value="">-- Select User Level --</option>
                                            <option value="0">0 - Super Administrator</option>
                                            <option value="1">1 - Administrator</option>
                                            <option value="2">2 - Manager</option>
                                            <option value="3">3 - Supervisor</option>
                                            <option value="4">4 - Leader</option>
                                            <option value="5">5 - Admin</option>
                                            <option value="6">6 - User</option>
                                        </select>
                                        <div class="invalid-feedback"></div>
                                    </div>
                                    <div class="form-group col-xl-3 col-lg-3 col-md-6 col-sm-12 mb-3 clearfix">
                                        <label class="form-label" for="data_password">Password <strong
                                                class="text-danger">*</strong></label>
                                        <input type="password" name="data_password" id="data_password"
                                            class="form-control rounded-0" placeholder="Password" maxlength="20"
                                            required autocomplete="off">
                                        <div class="invalid-feedback"></div>
                                    </div>
                                    <div class="form-group col-xl-12 col-lg-12 col-md-12 col-sm-12 clearfix">
                                        <label class="form-label" for="data_remark">Remark</label>
                                        <textarea name="data_remark" id="data_remark" class="summernote"
                                            placeholder="Remark"></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</main>
<?= $this->endSection(); ?>