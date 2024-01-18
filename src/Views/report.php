<div class="container">
    <div class="text-center my-5">
        <h1>Welcome to the Report Page</h1>
        <p>This is the report page content.</p>
    </div>

    <div class="container">
        <?php if (!empty($data['error'])){ ?>
            <div class="alert alert-danger"><?php echo $data['error']; ?></div>
        <?php } ?>
        <div class="card">
            <div class="card-header">
                <form action="report" method="get">
                    <div class="row">
                        <div class="col">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" name="user_name" class="form-control form-control-sm" id="name"
                                   placeholder="Name"
                                   value="<?php echo isset($_GET['user_name']) ? $_GET['user_name'] : ''; ?>">
                        </div>
                        <div class="col">
                            <label for="email" class="form-label">Email</label>
                            <input type="text" name="user_email" class="form-control form-control-sm" id="email"
                                   placeholder="Email"
                                   value="<?php echo isset($_GET['user_email']) ? $_GET['user_email'] : ''; ?>">
                        </div>
                        <div class="col">
                            <label for="product_name" class="form-label">Product Name</label>
                            <input type="text" name="product_name" class="form-control form-control-sm"
                                   id="product_name"
                                   placeholder="Product Name"
                                   value="<?php echo isset($_GET['product_name']) ? $_GET['product_name'] : ''; ?>">
                        </div>
                        <div class="col">
                            <label for="start_date" class="form-label">Start Date</label>
                            <input type="date" name="start_date" class="form-control form-control-sm" id="start_date"
                                   required placeholder="Start Date"
                                   value="<?php echo isset($_GET['start_date']) ? $_GET['start_date'] : ''; ?>">
                        </div>
                        <div class="col">
                            <label for="end_date" class="form-label">End Date</label>
                            <input type="date" name="end_date" class="form-control form-control-sm" id="end_date"
                                   required
                                   placeholder="End Date"
                                   value="<?php echo isset($_GET['end_date']) ? $_GET['end_date'] : ''; ?>">
                        </div>
                        <div class="col-1">
                            <div class="pt-2">
                                <button type="submit" class="btn btn-dark mt-4 w-100 btn-sm">Apply</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>


    <table class="table mt-5 table-light table-striped table-hover">
        <thead>
        <tr>
            <td class="bg-dark text-white">Customer Name</td>
            <td class="bg-dark text-white">Customer Email</td>
            <td class="bg-dark text-white">Product</td>
            <td class="bg-dark text-white">Price</td>
            <td class="bg-dark text-white">Date</td>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($data['data'] as $item) { ?>
            <tr>
                <td><?php echo $item['user_name'] ?></td>
                <td><?php echo $item['email'] ?></td>
                <td><?php echo $item['product_name'] ?></td>
                <td><?php echo $item['price'] ?></td>
                <td><?php echo $item['date'] ?></td>
            </tr>
        <?php } ?>
        </tbody>

    </table>
    <table class="table mt-5 ">
        <tbody>
        <tr>
            <td class="bg-dark text-white">Total sales:</td>
            <td class="bg-dark text-white"><?php echo $data['total_price']; ?></td>
        </tr>
        </tbody>
    </table>
    <?php
    $maxPagesToShow = 5;
    $currentPage = isset($_GET['page']) ? (int)$_GET['page'] : 1;
    $startPage = max(1, $currentPage - floor($maxPagesToShow / 2));
    $endPage = min($data['total_pages'], $startPage + $maxPagesToShow - 1);

    // Adjust if fewer pages are available than the desired range
    $startPage = max(1, min($startPage, $data['total_pages'] - $maxPagesToShow + 1));
    ?>

    <nav aria-label="Page navigation">
        <ul class="pagination justify-content-center">
            <!-- Previous Page Link -->
            <li class="page-item <?php if ($currentPage <= 1) echo 'disabled'; ?>">
                <a class="page-link"
                   href="?<?php echo http_build_query(array_merge($_GET, ['page' => max(1, $currentPage - 1)])); ?>">Previous</a>
            </li>

            <!-- Page Numbers -->
            <?php for ($i = $startPage; $i <= $endPage; $i++): ?>
                <li class="page-item <?php if ($i == $currentPage) echo 'active'; ?>">
                    <a class="page-link"
                       href="?<?php echo http_build_query(array_merge($_GET, ['page' => $i])); ?>"><?php echo $i; ?></a>
                </li>
            <?php endfor; ?>

            <!-- Next Page Link -->
            <li class="page-item <?php if ($currentPage >= $data['total_pages']) echo 'disabled'; ?>">
                <a class="page-link"
                   href="?<?php echo http_build_query(array_merge($_GET, ['page' => min($data['total_pages'], $currentPage + 1)])); ?>">Next</a>
            </li>
        </ul>
    </nav>
    </div>
