<?php include 'templates/header.php'; ?>

<div class="container mt-5">

    <div class="row justify-content-center">

        <div class="col-md-6">

            <div class="card shadow p-4">

                <h2 class="text-center mb-4">
                    Register Customer
                </h2>

                <form
                    action="auth/register_proses.php"
                    method="POST"
                >

                    <div class="mb-3">

                        <label>Nama Lengkap</label>

                        <input
                            type="text"
                            name="nama_customer"
                            class="form-control"
                            required
                        >

                    </div>

                    <div class="mb-3">

                        <label>Email</label>

                        <input
                            type="email"
                            name="email"
                            class="form-control"
                            required
                        >

                    </div>

                    <div class="mb-3">

                        <label>Password</label>

                        <input
                            type="password"
                            name="password"
                            class="form-control"
                            required
                        >

                    </div>

                    <div class="mb-3">

                        <label>Alamat</label>

                        <textarea
                            name="alamat"
                            class="form-control"
                        ></textarea>

                    </div>

                    <div class="mb-3">

                        <label>No HP</label>

                        <input
                            type="text"
                            name="no_hp"
                            class="form-control"
                        >

                    </div>

                    <button class="btn btn-success w-100">
                        Daftar
                    </button>

                </form>

            </div>

        </div>

    </div>

</div>

<?php include 'templates/footer.php'; ?>