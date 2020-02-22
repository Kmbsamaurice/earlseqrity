      <footer class="sticky-footer">
        <div class="container my-auto">
          <div class="copyright text-center my-auto">
            <span>© <?php echo date("Y");?>. Earl communications. All Rights Reserved.</span>
          </div>
        </div>
      </footer>
    </div>
  </div>
  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>
  <!-- Logout Modal-->
  <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
          <a class="btn btn-primary" href="<?php echo base_url('admin/logout');?>">Logout</a>
        </div>
      </div>
    </div>
  </div>
  <script src="<?php echo base_url('assets/backend/');?>js/jquery2.js"></script>
  <script src="<?php echo base_url('assets/backend/');?>js/bootstrap.bundle.min.js"></script>
  <script src="<?php echo base_url('assets/backend/');?>js/jquery.easing.min.js"></script>
  <script src="<?php echo base_url('assets/backend/');?>js/Chart.min.js"></script>
  <script src="<?php echo base_url('assets/backend/');?>datatables/jquery.dataTables.js"></script>
  <script src="<?php echo base_url('assets/backend/');?>datatables/dataTables.bootstrap4.js"></script>
  <script src="<?php echo base_url('assets/backend/');?>js/sb-admin.min.js"></script>
  <script src="<?php echo base_url('assets/backend/');?>js/demo/datatables-demo.js"></script>
  <script src="<?php echo base_url('assets/backend/');?>js/demo/chart-area-demo.js"></script>
</body>
</html>