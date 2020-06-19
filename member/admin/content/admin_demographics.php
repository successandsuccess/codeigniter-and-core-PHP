<style>
    .card-heading {
        cursor: pointer;
        position: relative;
    }

    .card-heading h2 {
        font-size: 24px;
        color: #f28e2b;
        font-weight: bold;
        text-align: center;
        margin: 0;
        text-transform: uppercase;
    }

    .back-white {
        background-color: #fff !important;
    }

    .area-heading {
        border-bottom: 1px solid #ddd !important;
        padding: 10px !important;
        display: flex !important;
        flex-direction: row !important;
        justify-content: space-between !important;
    }

    .table-heading-wrapper {
        display: flex !important;
        flex-direction: row !important;
        justify-content: space-between !important;
        padding: 10px 20px !important;
    }

    .table-heading {
        font-size: 16px !important;
        font-family: Circe;
        font-weight: bold !important;
    }

    .table-header {
        font-family: 'Roboto' !important;
        font-weight: bold;
        font-size: 10px !important;
        color: #000000 !important;
        background-color: rgba(253, 209, 130, 0.2);
    }

    .table-body td {
        font-family: 'Roboto' !important;
        font-weight: normal !important;
        font-size: 10px !important;
        color: #333333 !important;
    }

    .feature-label {
        font-family: 'Circe' !important;
        font-weight: bold;
        font-size: 14px !important;
        color: rgb(36, 96, 139) !important;
    }

    .tap {
        cursor: pointer !important;
    }

    .tap img {
        width: 14px !important;
        margin-top: -6px !important;
    }

    .tap i {
        font-size: 12px !important;
    }

    th, td {
        border-right: none !important;
        border-left: none !important;
    }

    .table-footer, .table-footer td {
        font-family: 'Roboto' !important;
        font-size: 14px !important;
        color: #333333 !important;
    }

    .collapsing {
        transition: all 1s linear;
    }

    .stats-heading {
        font-size: 16px;
        color: #000000;
        font-weight: bold;
        font-family: 'Circe';
    }

    .stats-ul {
        margin-left: -20px;
        margin-top: 7px;
        margin-bottom: 20px;
        font-size: 14px;
        color: #000000;
    }

    .stats-li {
        font-family: CirceRegular;
    }
</style>

<div id="toggler-down" class="card-heading card" data-toggle="collapse" data-target="#demographics-card" aria-expanded="false"
     aria-controls="demographics-card">
    <h2>Demographics and geographics</h2>
    <span class="toggler"><img src="images/arrow-doen.png" alt=""></span>
</div>
<div id="toggler-up" class="card-heading card" data-toggle="collapse" data-target="#demographics-card" aria-expanded="false"
     aria-controls="demographics-card" style="display: none;">
    <h2>Demographics and geographics</h2>
    <span class="toggler"><img style="transform: rotate(180deg);margin-top: -4px;" src="images/arrow-doen.png" alt=""></span>
</div>
<div class="collapse" id="demographics-card">
    <div class="card">
        <div class="row">
            <div class="col-md-12">
                <div class="area-heading">
                    <span class="table-heading">
                        DEMOGRAPHICS AND GEOGRAPHICS
                    </span>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-9">
                <div class="tap" style="float: right;margin: 30px 0 5px 0;padding-right: 10px;">
                    <img src="../assets/images/earmark.svg" alt="earmark"/>
                    <span class="feature-label">Export all tables to excel</span>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-9">
                <table class="table table-striped table-bordered nowrap" style="width:100%">
                    <thead>
                    <col width="30%"/>
                    <col width="18%"/>
                    <col width="12%"/>
                    <col width="7%"/>
                    <col width="8%"/>
                    <col width="13%"/>
                    <col width="20%"/>
                    <tr>
                        <th colspan="7" class="back-white">
                            <div class="table-heading-wrapper">
                                <span class="table-heading">Age (By Generation)</span>
                                <div style="display: flex;">
                                    <div class="tap">
                                        <img src="../assets/images/earmark.svg" alt="earmark"/>
                                        <span class="feature-label">Export</span>
                                    </div>
                                    <div class="tap" style="margin-left: 20px;">
                                        <i style="color: #4e79a7;" class="fa fa-print"></i>
                                        <span class="feature-label">Print</span>
                                    </div>
                                </div>
                            </div>
                        </th>
                    </tr>
                    <tr>
                        <th class="table-header">

                        </th>
                        <th class="table-header">
                            Total CAAs
                        </th>
                        <th class="table-header">
                            Reported
                        </th>
                        <th class="table-header">
                            Percentage
                        </th>
                        <th class="table-header">
                            Remaining
                        </th>
                        <th class="table-header">
                            <div style="display: flex;">
                                <span style="font-weight: bold;">#</span>
                                <i style="margin-left: 2px;margin-top: 2px;" class="fa fa-caret-up"></i>
                            </div>
                        </th>
                        <th class="table-header">
                            <div style="display: flex;">
                                <span style="font-weight: bold;">%</span>
                                <i style="margin-left: 2px;margin-top: 2px;" class="fa fa-caret-up"></i>
                            </div>
                        </th>
                    </tr>
                    </thead>
                    <tbody class="table-body">
                    <tr>
                        <td>Gen Z (1997-)</td>
                        <td>2,750</td>
                        <td>759</td>
                        <td>27.6%</td>
                        <td>1,991</td>
                        <td>15</td>
                        <td>1.47%</td>
                    </tr>
                    <tr>
                        <td>Millennials (1980-1996)</td>
                        <td>2,750</td>
                        <td>759</td>
                        <td>27.6%</td>
                        <td>1,991</td>
                        <td>626</td>
                        <td>78.71%</td>
                    </tr>
                    <tr>
                        <td>Gen X(1965-1979)</td>
                        <td>2,750</td>
                        <td>759</td>
                        <td>27.6%</td>
                        <td>1,991</td>
                        <td>150</td>
                        <td>14.17%</td>
                    </tr>
                    <tr>
                        <td>Boomers (1946-1964)</td>
                        <td>2,750</td>
                        <td>759</td>
                        <td>27.6%</td>
                        <td>1,991</td>
                        <td>42</td>
                        <td>5.44%</td>
                    </tr>
                    <tr>
                        <td>Silent (1925-1945)</td>
                        <td>2,750</td>
                        <td>759</td>
                        <td>27.6%</td>
                        <td>1,991</td>
                        <td>2</td>
                        <td>0.11%</td>
                    </tr>
                    <tr class="table-footer">
                        <td colspan="5">Totals</td>
                        <td>759</td>
                        <td>100%</td>
                    </tr>
                    </tbody>
                </table>

                <table class="table table-striped table-bordered nowrap" style="width:100%">
                    <thead>
                    <col width="30%"/>
                    <col width="18%"/>
                    <col width="12%"/>
                    <col width="7%"/>
                    <col width="8%"/>
                    <col width="13%"/>
                    <col width="20%"/>
                    <tr>
                        <th colspan="7" class="back-white">
                            <div class="table-heading-wrapper">
                                <span  class="table-heading">Gender</span>
                                <div style="display: flex;">
                                    <div class="tap">
                                        <img src="../assets/images/earmark.svg" alt="earmark"/>
                                        <span class="feature-label">Export</span>
                                    </div>
                                    <div class="tap" style="margin-left: 20px;">
                                        <i style="color: #4e79a7;" class="fa fa-print"></i>
                                        <span class="feature-label">Print</span>
                                    </div>
                                </div>
                            </div>
                        </th>
                    </tr>
                    <tr>
                        <th class="table-header">

                        </th>
                        <th class="table-header">
                            Total CAAs
                        </th>
                        <th class="table-header">
                            Reported
                        </th>
                        <th class="table-header">
                            Percentage
                        </th>
                        <th class="table-header">
                            Remaining
                        </th>
                        <th class="table-header">
                            <div style="display: flex;">
                                <span style="font-weight: bold;">#</span>
                                <i style="margin-left: 2px;margin-top: 2px;" class="fa fa-caret-up"></i>
                            </div>
                        </th>
                        <th class="table-header">
                            <div style="display: flex;">
                                <span style="font-weight: bold;">%</span>
                                <i style="margin-left: 2px;margin-top: 2px;" class="fa fa-caret-up"></i>
                            </div>
                        </th>
                    </tr>
                    </thead>
                    <tbody class="table-body">
                    <tr>
                        <td>Male</td>
                        <td>2,750</td>
                        <td>413</td>
                        <td>15.0%</td>
                        <td>2,337</td>
                        <td>200</td>
                        <td>48.4%</td>
                    </tr>
                    <tr>
                        <td>Female</td>
                        <td>2,750</td>
                        <td>413</td>
                        <td>15.0%</td>
                        <td>1,991</td>
                        <td>213</td>
                        <td>51.6%</td>
                    </tr>
                    <tr class="table-footer">
                        <td colspan="5">Totals</td>
                        <td>759</td>
                        <td>100%</td>
                    </tr>
                    </tbody>
                </table>

                <table class="table table-striped table-bordered nowrap" style="width:100%">
                    <thead>
                    <col width="30%"/>
                    <col width="18%"/>
                    <col width="18%"/>
                    <col width="18%"/>
                    <col width="25%"/>
                    <tr>
                        <th colspan="5" class="back-white">
                            <div class="table-heading-wrapper">
                                <span  class="table-heading">Gender (By Generation)</span>
                                <div style="display: flex;">
                                    <div class="tap">
                                        <img src="../assets/images/earmark.svg" alt="earmark"/>
                                        <span class="feature-label">Export</span>
                                    </div>
                                    <div class="tap" style="margin-left: 20px;">
                                        <i style="color: #4e79a7;" class="fa fa-print"></i>
                                        <span class="feature-label">Print</span>
                                    </div>
                                </div>
                            </div>
                        </th>
                    </tr>
                    <tr>
                        <th class="table-header">

                        </th>
                        <th class="table-header">
                            <div style="display: flex;">
                                <span class="table-header">Male</span>
                                <i style="margin-left: 2px;margin-top: 2px;" class="fa fa-caret-up"></i>
                            </div>
                        </th>
                        <th class="table-header">
                            <div style="display: flex;">
                                <span class="table-header">Female</span>
                                <i style="margin-left: 2px;margin-top: 2px;" class="fa fa-caret-up"></i>
                            </div>
                        </th>
                        <th class="table-header">
                            <div style="display: flex;">
                                <span class="table-header">Male %</span>
                                <i style="margin-left: 2px;margin-top: 2px;" class="fa fa-caret-up"></i>
                            </div>
                        </th>
                        <th class="table-header">
                            <div style="display: flex;">
                                <span class="table-header">Female %</span>
                                <i style="margin-left: 2px;margin-top: 2px;" class="fa fa-caret-up"></i>
                            </div>
                        </th>
                    </tr>
                    </thead>
                    <tbody class="table-body">
                    <tr>
                        <td>Gen Z (1997-)</td>
                        <td>2,750</td>
                        <td>759</td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>Millennials (1980-1996)</td>
                        <td>2,750</td>
                        <td>759</td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>Gen X (1965-1979)</td>
                        <td>2,750</td>
                        <td>759</td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>Boomers (1946-1964)</td>
                        <td>2,750</td>
                        <td>759</td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>Silent (1925-1945)</td>
                        <td>2,750</td>
                        <td>759</td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr  class="table-footer">
                        <td>Totals</td>
                        <td>200</td>
                        <td>213</td>
                        <td>48.4%</td>
                        <td>516.%</td>
                    </tr>
                    </tbody>
                </table>

                <table class="table table-striped table-bordered nowrap" style="width:100%">
                    <thead>
                    <col width="30%"/>
                    <col width="18%"/>
                    <col width="12%"/>
                    <col width="7%"/>
                    <col width="8%"/>
                    <col width="13%"/>
                    <col width="20%"/>
                    <tr>
                        <th colspan="7" class="back-white">
                            <div class="table-heading-wrapper">
                                <span  class="table-heading">Race</span>
                                <div style="display: flex;">
                                    <div class="tap">
                                        <img src="../assets/images/earmark.svg" alt="earmark"/>
                                        <span class="feature-label">Export</span>
                                    </div>
                                    <div class="tap" style="margin-left: 20px;">
                                        <i style="color: #4e79a7;" class="fa fa-print"></i>
                                        <span class="feature-label">Print</span>
                                    </div>
                                </div>
                            </div>
                        </th>
                    </tr>
                    <tr>
                        <th class="table-header">

                        </th>
                        <th class="table-header">
                            Total CAAs
                        </th>
                        <th class="table-header">
                            Reported
                        </th>
                        <th class="table-header">
                            Percentage
                        </th>
                        <th class="table-header">
                            Remaining
                        </th>
                        <th class="table-header">
                            <div style="display: flex;">
                                <span style="font-weight: bold;">#</span>
                                <i style="margin-left: 2px;margin-top: 2px;" class="fa fa-caret-up"></i>
                            </div>
                        </th>
                        <th class="table-header">
                            <div style="display: flex;">
                                <span style="font-weight: bold;">%</span>
                                <i style="margin-left: 2px;margin-top: 2px;" class="fa fa-caret-up"></i>
                            </div>
                        </th>
                    </tr>
                    </thead>
                    <tbody class="table-body">
                    <tr>
                        <td>Asian</td>
                        <td>2,750</td>
                        <td>759</td>
                        <td>27.6%</td>
                        <td>1,991</td>
                        <td>15</td>
                        <td>1.47%</td>
                    </tr>
                    <tr>
                        <td>Amer, Indian or Alkn. NA</td>
                        <td>2,750</td>
                        <td>759</td>
                        <td>27.6%</td>
                        <td>1,991</td>
                        <td>626</td>
                        <td>78.71%</td>
                    </tr>
                    <tr>
                        <td>Black/African American</td>
                        <td>2,750</td>
                        <td>759</td>
                        <td>27.6%</td>
                        <td>1,991</td>
                        <td>150</td>
                        <td>14.27%</td>
                    </tr>
                    <tr>
                        <td>Latino/Hispanic</td>
                        <td>2,750</td>
                        <td>759</td>
                        <td>27.6%</td>
                        <td>1,991</td>
                        <td>42</td>
                        <td>5.44%</td>
                    </tr>
                    <tr>
                        <td>NA. Hawaiian/P. Islander</td>
                        <td>2,750</td>
                        <td>759</td>
                        <td>27.6%</td>
                        <td>1,991</td>
                        <td>2</td>
                        <td>0.11%</td>
                    </tr>
                    <tr>
                        <td>Middle Eastern</td>
                        <td>2,750</td>
                        <td>759</td>
                        <td>27.6%</td>
                        <td>1,991</td>
                        <td>626</td>
                        <td>78.71%</td>
                    </tr>
                    <tr>
                        <td>White or Caucasian</td>
                        <td>2,750</td>
                        <td>759</td>
                        <td>27.6%</td>
                        <td>1,991</td>
                        <td>150</td>
                        <td>14.27%</td>
                    </tr>
                    <tr>
                        <td>Other</td>
                        <td>2,750</td>
                        <td>759</td>
                        <td>27.6%</td>
                        <td>1,991</td>
                        <td>42</td>
                        <td>5.44%</td>
                    </tr>
                    <tr  class="table-footer">
                        <td colspan="5">Totals</td>
                        <td>759</td>
                        <td>100%</td>
                    </tr>
                    </tbody>
                </table>

                <table class="table table-striped table-bordered nowrap" style="width:100%">
                    <thead>
                    <col width="30%"/>
                    <col width="18%"/>
                    <col width="12%"/>
                    <col width="7%"/>
                    <col width="8%"/>
                    <col width="13%"/>
                    <col width="20%"/>
                    <tr>
                        <th colspan="7" class="back-white">
                            <div class="table-heading-wrapper">
                                <span  class="table-heading">ZIP CODE (by State)</span>
                                <div style="display: flex;">
                                    <div class="tap">
                                        <img src="../assets/images/earmark.svg" alt="earmark"/>
                                        <span class="feature-label">Export</span>
                                    </div>
                                    <div class="tap" style="margin-left: 20px;">
                                        <i style="color: #4e79a7;" class="fa fa-print"></i>
                                        <span class="feature-label">Print</span>
                                    </div>
                                </div>
                            </div>
                        </th>
                    </tr>
                    <tr>
                        <th class="table-header">

                        </th>
                        <th class="table-header">
                            Total CAAs
                        </th>
                        <th class="table-header">
                            Reported
                        </th>
                        <th class="table-header">
                            Percentage
                        </th>
                        <th class="table-header">
                            Remaining
                        </th>
                        <th class="table-header">
                            <div style="display: flex;">
                                <span style="font-weight: bold;">#</span>
                                <i style="margin-left: 2px;margin-top: 2px;" class="fa fa-caret-up"></i>
                            </div>
                        </th>
                        <th class="table-header">
                            <div style="display: flex;">
                                <span style="font-weight: bold;">%</span>
                                <i style="margin-left: 2px;margin-top: 2px;" class="fa fa-caret-up"></i>
                            </div>
                        </th>
                    </tr>
                    </thead>
                    <tbody class="table-body">
                    <tr>
                        <td>Alabama</td>
                        <td>2,750</td>
                        <td>759</td>
                        <td>27.6%</td>
                        <td>1,991</td>
                        <td>15</td>
                        <td>1.47%</td>
                    </tr>
                    <tr>
                        <td>Alaska</td>
                        <td>2,750</td>
                        <td>759</td>
                        <td>27.6%</td>
                        <td>1,991</td>
                        <td>626</td>
                        <td>78.71%</td>
                    </tr>
                    <tr>
                        <td>Arizona</td>
                        <td>2,750</td>
                        <td>759</td>
                        <td>27.6%</td>
                        <td>1,991</td>
                        <td>150</td>
                        <td>14.27%</td>
                    </tr>
                    <tr>
                        <td>Arkanzas</td>
                        <td>2,750</td>
                        <td>759</td>
                        <td>27.6%</td>
                        <td>1,991</td>
                        <td>42</td>
                        <td>5.44%</td>
                    </tr>
                    <tr>
                        <td>California</td>
                        <td>2,750</td>
                        <td>759</td>
                        <td>27.6%</td>
                        <td>1,991</td>
                        <td>2</td>
                        <td>0.11%</td>
                    </tr>
                    <tr>
                        <td>Colorado</td>
                        <td>2,750</td>
                        <td>759</td>
                        <td>27.6%</td>
                        <td>1,991</td>
                        <td>626</td>
                        <td>78.71%</td>
                    </tr>
                    <tr>
                        <td>Connecticut</td>
                        <td>2,750</td>
                        <td>759</td>
                        <td>27.6%</td>
                        <td>1,991</td>
                        <td>150</td>
                        <td>14.27%</td>
                    </tr>
                    <tr>
                        <td>DC</td>
                        <td>2,750</td>
                        <td>759</td>
                        <td>27.6%</td>
                        <td>1,991</td>
                        <td>15</td>
                        <td>1.47%</td>
                    </tr>
                    <tr>
                        <td>Delaware</td>
                        <td>2,750</td>
                        <td>759</td>
                        <td>27.6%</td>
                        <td>1,991</td>
                        <td>626</td>
                        <td>78.71%</td>
                    </tr>
                    <tr>
                        <td>Florida</td>
                        <td>2,750</td>
                        <td>759</td>
                        <td>27.6%</td>
                        <td>1,991</td>
                        <td>150</td>
                        <td>14.27%</td>
                    </tr>
                    <tr>
                        <td>Georgia</td>
                        <td>2,750</td>
                        <td>759</td>
                        <td>27.6%</td>
                        <td>1,991</td>
                        <td>42</td>
                        <td>5.44%</td>
                    </tr>
                    <tr>
                        <td>Hawaii</td>
                        <td>2,750</td>
                        <td>759</td>
                        <td>27.6%</td>
                        <td>1,991</td>
                        <td>2</td>
                        <td>0.11%</td>
                    </tr>
                    <tr>
                        <td>Idaho</td>
                        <td>2,750</td>
                        <td>759</td>
                        <td>27.6%</td>
                        <td>1,991</td>
                        <td>626</td>
                        <td>78.71%</td>
                    </tr>
                    <tr>
                        <td>Iowa</td>
                        <td>2,750</td>
                        <td>759</td>
                        <td>27.6%</td>
                        <td>1,991</td>
                        <td>150</td>
                        <td>14.27%</td>
                    </tr>
                    <tr>
                        <td>Kansas</td>
                        <td>2,750</td>
                        <td>759</td>
                        <td>27.6%</td>
                        <td>1,991</td>
                        <td>15</td>
                        <td>1.47%</td>
                    </tr>
                    <tr>
                        <td>Kentucky</td>
                        <td>2,750</td>
                        <td>759</td>
                        <td>27.6%</td>
                        <td>1,991</td>
                        <td>626</td>
                        <td>78.71%</td>
                    </tr>
                    <tr>
                        <td>Louisiana</td>
                        <td>2,750</td>
                        <td>759</td>
                        <td>27.6%</td>
                        <td>1,991</td>
                        <td>150</td>
                        <td>14.27%</td>
                    </tr>
                    <tr>
                        <td>Maine</td>
                        <td>2,750</td>
                        <td>759</td>
                        <td>27.6%</td>
                        <td>1,991</td>
                        <td>42</td>
                        <td>5.44%</td>
                    </tr>
                    <tr>
                        <td>Maryland</td>
                        <td>2,750</td>
                        <td>759</td>
                        <td>27.6%</td>
                        <td>1,991</td>
                        <td>2</td>
                        <td>0.11%</td>
                    </tr>
                    <tr>
                        <td>Massachusetts</td>
                        <td>2,750</td>
                        <td>759</td>
                        <td>27.6%</td>
                        <td>1,991</td>
                        <td>626</td>
                        <td>78.71%</td>
                    </tr>
                    <tr>
                        <td>Michigan</td>
                        <td>2,750</td>
                        <td>759</td>
                        <td>27.6%</td>
                        <td>1,991</td>
                        <td>150</td>
                        <td>14.27%</td>
                    </tr>
                    <tr>
                        <td>Mississippi</td>
                        <td>2,750</td>
                        <td>759</td>
                        <td>27.6%</td>
                        <td>1,991</td>
                        <td>15</td>
                        <td>1.47%</td>
                    </tr>
                    <tr>
                        <td>Missouri</td>
                        <td>2,750</td>
                        <td>759</td>
                        <td>27.6%</td>
                        <td>1,991</td>
                        <td>626</td>
                        <td>78.71%</td>
                    </tr>
                    <tr>
                        <td>Montana</td>
                        <td>2,750</td>
                        <td>759</td>
                        <td>27.6%</td>
                        <td>1,991</td>
                        <td>150</td>
                        <td>14.27%</td>
                    </tr>
                    <tr>
                        <td>Nebraska</td>
                        <td>2,750</td>
                        <td>759</td>
                        <td>27.6%</td>
                        <td>1,991</td>
                        <td>42</td>
                        <td>5.44%</td>
                    </tr>
                    <tr>
                        <td>Nevada</td>
                        <td>2,750</td>
                        <td>759</td>
                        <td>27.6%</td>
                        <td>1,991</td>
                        <td>2</td>
                        <td>0.11%</td>
                    </tr>
                    <tr>
                        <td>New Hampshire</td>
                        <td>2,750</td>
                        <td>759</td>
                        <td>27.6%</td>
                        <td>1,991</td>
                        <td>626</td>
                        <td>78.71%</td>
                    </tr>
                    <tr>
                        <td>New Jersey</td>
                        <td>2,750</td>
                        <td>759</td>
                        <td>27.6%</td>
                        <td>1,991</td>
                        <td>150</td>
                        <td>14.27%</td>
                    </tr>
                    <tr>
                        <td>New mexico</td>
                        <td>2,750</td>
                        <td>759</td>
                        <td>27.6%</td>
                        <td>1,991</td>
                        <td>15</td>
                        <td>1.47%</td>
                    </tr>
                    <tr>
                        <td>New York</td>
                        <td>2,750</td>
                        <td>759</td>
                        <td>27.6%</td>
                        <td>1,991</td>
                        <td>626</td>
                        <td>78.71%</td>
                    </tr>
                    <tr>
                        <td>North Carolina</td>
                        <td>2,750</td>
                        <td>759</td>
                        <td>27.6%</td>
                        <td>1,991</td>
                        <td>150</td>
                        <td>14.27%</td>
                    </tr>
                    <tr>
                        <td>North Dakota</td>
                        <td>2,750</td>
                        <td>759</td>
                        <td>27.6%</td>
                        <td>1,991</td>
                        <td>42</td>
                        <td>5.44%</td>
                    </tr>
                    <tr>
                        <td>Ohio</td>
                        <td>2,750</td>
                        <td>759</td>
                        <td>27.6%</td>
                        <td>1,991</td>
                        <td>2</td>
                        <td>0.11%</td>
                    </tr>
                    <tr>
                        <td>Oklahoma</td>
                        <td>2,750</td>
                        <td>759</td>
                        <td>27.6%</td>
                        <td>1,991</td>
                        <td>626</td>
                        <td>78.71%</td>
                    </tr>
                    <tr>
                        <td>Oregon</td>
                        <td>2,750</td>
                        <td>759</td>
                        <td>27.6%</td>
                        <td>1,991</td>
                        <td>150</td>
                        <td>14.27%</td>
                    </tr>
                    <tr>
                        <td>Pennsylvania</td>
                        <td>2,750</td>
                        <td>759</td>
                        <td>27.6%</td>
                        <td>1,991</td>
                        <td>15</td>
                        <td>1.47%</td>
                    </tr>
                    <tr>
                        <td>Rhode Island</td>
                        <td>2,750</td>
                        <td>759</td>
                        <td>27.6%</td>
                        <td>1,991</td>
                        <td>626</td>
                        <td>78.71%</td>
                    </tr>
                    <tr>
                        <td>South Carolina</td>
                        <td>2,750</td>
                        <td>759</td>
                        <td>27.6%</td>
                        <td>1,991</td>
                        <td>150</td>
                        <td>14.27%</td>
                    </tr>
                    <tr>
                        <td>South Dakota</td>
                        <td>2,750</td>
                        <td>759</td>
                        <td>27.6%</td>
                        <td>1,991</td>
                        <td>42</td>
                        <td>5.44%</td>
                    </tr>
                    <tr>
                        <td>Tennessee</td>
                        <td>2,750</td>
                        <td>759</td>
                        <td>27.6%</td>
                        <td>1,991</td>
                        <td>2</td>
                        <td>0.11%</td>
                    </tr>
                    <tr>
                        <td>Texas</td>
                        <td>2,750</td>
                        <td>759</td>
                        <td>27.6%</td>
                        <td>1,991</td>
                        <td>626</td>
                        <td>78.71%</td>
                    </tr>
                    <tr>
                        <td>Utah</td>
                        <td>2,750</td>
                        <td>759</td>
                        <td>27.6%</td>
                        <td>1,991</td>
                        <td>150</td>
                        <td>14.27%</td>
                    </tr>
                    <tr>
                        <td>Vermont</td>
                        <td>2,750</td>
                        <td>759</td>
                        <td>27.6%</td>
                        <td>1,991</td>
                        <td>15</td>
                        <td>1.47%</td>
                    </tr>
                    <tr>
                        <td>Virginia</td>
                        <td>2,750</td>
                        <td>759</td>
                        <td>27.6%</td>
                        <td>1,991</td>
                        <td>626</td>
                        <td>78.71%</td>
                    </tr>
                    <tr>
                        <td>Washington</td>
                        <td>2,750</td>
                        <td>759</td>
                        <td>27.6%</td>
                        <td>1,991</td>
                        <td>150</td>
                        <td>14.27%</td>
                    </tr>
                    <tr>
                        <td>West Virginia</td>
                        <td>2,750</td>
                        <td>759</td>
                        <td>27.6%</td>
                        <td>1,991</td>
                        <td>42</td>
                        <td>5.44%</td>
                    </tr>
                    <tr>
                        <td>Wisconsin</td>
                        <td>2,750</td>
                        <td>759</td>
                        <td>27.6%</td>
                        <td>1,991</td>
                        <td>2</td>
                        <td>0.11%</td>
                    </tr>
                    <tr>
                        <td>Wyoming</td>
                        <td>2,750</td>
                        <td>759</td>
                        <td>27.6%</td>
                        <td>1,991</td>
                        <td>626</td>
                        <td>78.71%</td>
                    </tr>
                    <tr class="table-footer">
                        <td colspan="5">Totals</td>
                        <td>759</td>
                        <td>100%</td>
                    </tr>
                    </tbody>
                </table>
            </div>

            <div class="col-md-3">
                <div style="border: 1px solid #ddd;padding: 20px 10px;">
                    <span class="stats-heading">BIRTH DATE</span>
                    <ul class="stats-ul">
                        <li class="stats-li">
                            Total CAAs: 2,750
                        </li>
                        <li>
                            Reported: 759
                        </li>
                        <li>
                            Percentage: 27.6%
                        </li>
                        <li>
                            Remaining: 1,991
                        </li>
                    </ul>

                    <span class="stats-heading">GENDER</span>
                    <ul class="stats-ul">
                        <li class="stats-li">
                            Total CAAs: 2,750
                        </li>
                        <li class="stats-li">
                            Reported: 759
                        </li>
                        <li class="stats-li">
                            Percentage: 27.6%
                        </li>
                        <li class="stats-li">
                            Remaining: 1,991
                        </li>
                    </ul>

                    <span class="stats-heading">RACE</span>
                    <ul class="stats-ul">
                        <li class="stats-li">
                            Total CAAs: 2,750
                        </li>
                        <li class="stats-li">
                            Reported: 759
                        </li>
                        <li class="stats-li">
                            Percentage: 27.6%
                        </li>
                        <li class="stats-li">
                            Remaining: 1,991
                        </li>
                    </ul>

                    <span class="stats-heading">ZIP CODE</span>
                    <ul class="stats-ul">
                        <li class="stats-li">
                            Total CAAs: 2,750
                        </li>
                        <li class="stats-li">
                            Reported: 759
                        </li>
                        <li class="stats-li">
                            Percentage: 27.6%
                        </li>
                        <li class="stats-li">
                            Remaining: 1,991
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $("#toggler-up").click(function () {
            $(this).hide();
            $("#toggler-down").show();
        });

        $("#toggler-down").click(function () {
            $(this).hide();
            $("#toggler-up").show();
        });

        $(".top-heading").children(".toggler").removeClass("active");
        $(".admin-cards").hide();
    });
</script>