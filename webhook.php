
<!doctype html>
<html>
<?php require_once('./header.html'); ?>
<body>
<div class="container">
    <div class="row">
        <div class="col-9">
            <div class="row">
                <div class="col-9 webhooks">
                    <div class="row">
                        <div class="contents col-12">
                            <div class="col-md-12">
                                <h3>Webhooks Notifications</h3>
                                <div class="alert alert-info" role="alert">
                                    <!-- Info about Webhooks Endpoint -->
                                </div>
                            </div>
                        </div>
                    </div> <!-- row -->
                    <div class="row">
                        <div class="contents col-12">
                            <table class="table invisible notifications" style="line-height:1rem;">
                                <thead>
                                <tr>
                                    <th scope="col">Timestamp</th>
                                    <th scope="col">Order Id</th>
                                    <th scope="col">Transaction Id</th>
                                    <th scope="col">Order Status</th>
                                    <th scope="col">Amount</th>
                                </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="./webhooks.js"></script>
</body>
</html>
