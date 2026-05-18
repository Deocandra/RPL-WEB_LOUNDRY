<?php include 'templates/header.php'; ?>

<div class="container mt-5">

    <div class="row justify-content-center">

        <div class="col-md-5">

            <div class="card shadow p-4">

                <h2 class="text-center mb-4">
                    Login
                </h2>

                <form
                    action="auth/login_proses.php"
                    method="POST"
                >

                    <div class="mb-3">

                        <label>Email / Username</label>

                        <input
                            type="text"
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

                    <button class="btn btn-primary w-100">
                        Login
                    </button>

                </form>

            </div>

        </div>

    </div>

</div>

<?php include 'templates/footer.php'; ?>