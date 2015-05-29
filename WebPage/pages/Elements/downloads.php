<!-- /.row -->
            <div class="row">
                <div class="col-lg-6 col-md-6">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-database fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="hugeTitle">Raw Data</div>
                                    <div><?php echo $size ?>mb uncompressed</div>
                                </div>
                            </div>
                        </div>
                        <a href="Raw.zip" download="<?php echo "Pi_" . "$Pi_Number" . "_Raw_" . "$day"?>">
                            <div class="panel-footer">
                                <span class="pull-left">Download</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-down"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6">
                    <div class="panel panel-green">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-file-text fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="hugeTitle">Summary Data</div>
									<div><?php echo $free_space ?>gb Free Disk Space</div>
                                </div>
                            </div>
                        </div>
                        <a href="Summary.zip" download="<?php echo "Pi_" . "$Pi_Number" . "_Summary_" . "$day"?>">
                            <div class="panel-footer">
                                <span class="pull-left">Download</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-down"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
            <!-- /.row -->
