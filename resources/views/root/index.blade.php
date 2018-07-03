@extends('layout.app')

@section('content')
      <div class="panel panel-default">
        <div class="panel-body">
          <ul class="nav nav-tabs content m_u20">
            @can('application')<li @if($active == 'application') class="active" @endif><a href="#contentA" data-toggle="tab">申請</a></li>@endcan
            @can('loan')<li @if($active == 'loan') class="active" @endif><a href="#contentB" data-toggle="tab">貸与</a></li>@endcan
            @can('refund')<li @if($active == 'refund') class="active" @endif><a href="#contentC" data-toggle="tab">返還</a></li>@endcan
            @can('statistic')<li @if($active == 'statistic') class="active" @endif><a href="#contentD" data-toggle="tab">統計資料</a></li>@endcan
            @can('negotiate')<li @if($active == 'negotiate') class="active" @endif><a href="#contentE" data-toggle="tab">交渉履歴</a></li>@endcan
            @can('master')<li @if($active == 'master') class="active" @endif><a href="#contentF" data-toggle="tab">マスタ</a></li>@endcan
          </ul>
          <div class="tab-content">
            @can('application')
            <div class="tab-pane @if($active == 'application') active @endif " id="contentA">
              <div class="clearfix">
                <div class="fl w49 m_r2">
                  <a class="print-group btn block btn-default btn-sm" href="{{ route('application.create') }}">申請者の登録</a>
                  <a class="print-group btn block btn-default btn-sm" href="{{ route('application.index') }}">申請者一覧</a>
                  <a class="print-group btn block btn-default btn-sm" href="{{ route('application.selection') }}">選考結果登録</a>
                </div>
                <!-- / .fl -->
                <div class="fl w49">
                  <a class="print-group btn block btn-default btn-sm" href="{{ route('application.start_loan_emg') }}">緊急採用登録</a>
                  <a class="print-group btn block btn-default btn-sm" href="{{ route('application.history') }}">変更履歴</a>
                  <a class="print-group btn block btn-default btn-sm" href="{{ route('application.bulk_loan') }}">貸与開始一括登録</a>
                </div>
                <!-- / .fl -->
              </div>
              <!-- / . -->
            </div>
            <!-- / .tab-pane#contentA -->
            @endcan

            @can('loan')
            <div class="tab-pane @if($active == 'loan') active @endif " id="contentB">
              <div class="clearfix">
                <div class="fl w49 m_r2">
                  <a class="print-group btn block btn-default btn-sm" href="{{ route('loan.payment_burden.create') }}">支出負担行為一覧表作成</a>
                  <a class="print-group btn block btn-default btn-sm" href="{{ route('loan.payment_burden.confirm') }}">支出負担行為の確認・取り消し</a>
                  <a class="print-group btn block btn-default btn-sm" href="{{ route('loan.payment.create') }}">支給額調書作成</a>
                  <a class="print-group btn block btn-default btn-sm" href="{{ route('loan.payment.data') }}">支払いデータ作成</a>
                  <a class="print-group btn block btn-default btn-sm" href="{{ route('loan.payment.confirm') }}">支払いの確認・取り消し</a>
                </div>
                <!-- / .fl -->
                <div class="fl w49">
                  <a class="print-group btn block btn-default btn-sm" href="{{ route('loan.management.index') }}">貸与者一覧</a>
                  <a class="print-group btn block btn-default btn-sm" href="{{ route('loan.borrowed.index') }}">借用証明書の作成・取り消し</a>
                </div>
                <!-- / .fl -->
              </div>
              <!-- / . -->
            </div>
            <!-- / .tab-pane#contentB -->
            @endcan

            @can('refund')
            <div class="tab-pane @if($active == 'refund') active @endif " id="contentC">
              <div class="clearfix">
                <div class="fl w49 m_r2">
                  <a class="print-group btn block btn-default btn-sm" href="{{ route('refund.borrowed') }}">借用証明書の作成</a>
                  <a class="print-group btn block btn-default btn-sm" href="{{ route('refund.index') }}">貸与者一覧</a>
                  <a class="print-group btn block btn-default btn-sm" href="{{ route('refund.billing') }}">調定・納付通知書の作成</a>
                </div>
                <!-- / .fl -->
                <div class="fl w49">
                  <a class="print-group btn block btn-default btn-sm" href="{{ route('refund.delinquency') }}">督促状兼納付書の作成</a>
                  <a class="print-group btn block btn-default btn-sm" href="{{ route('refund.regist_completed') }}">返還終了者の登録</a>
                </div>
                <!-- / .fl -->
              </div>
              <!-- / . -->
            </div>
            <!-- / .tab-pane#contentC -->
            @endcan

            @can('statistic')
            <div class="tab-pane @if($active == 'statistic') active @endif " id="contentD">
              <div class="clearfix">
                <div class="fl w49 m_r2">
                  <a class="print-group btn block btn-default btn-sm" href="{{ route('statistic.revenue_calculation') }}">貸付金元利収入算定表</a>
                  <a class="print-group btn block btn-default btn-sm" href="{{ route('statistic.revenue_total') }}">貸付金元利収入合計表</a>
                  <a class="print-group btn block btn-default btn-sm" href="{{ route('statistic.annual_situation') }}">会計年度別調定・収入状況表</a>
                  <a class="print-group btn block btn-default btn-sm" href="{{ route('statistic.refund_prospect') }}">返還金回収見込み額一覧</a>
                </div>
                <!-- / .fl -->
                <div class="fl w49">
                  <a class="print-group btn block btn-default btn-sm" href="{{ route('statistic.loan_record') }}">国庫補助対象者貸与実績一覧表</a>
                  <a class="print-group btn block btn-default btn-sm" href="{{ route('statistic.refund_record') }}">国庫補助対象者収納実績一覧表</a>
                  <a class="print-group btn block btn-default btn-sm" href="{{ route('statistic.basic_deduction') }}">国庫補助資料基礎控除一覧表</a>
                </div>
                <!-- / .fl -->
              </div>
              <!-- / . -->
            </div>
            <!-- / .tab-pane#contentD -->
            @endcan

            @can('negotiate')
            <div class="tab-pane @if($active == 'negotiate') active @endif " id="contentE">
              <div class="clearfix">
                <div class="fl w49 m_r2">
                  <a class="print-group btn block btn-default btn-sm" href="{{ route('negotiate.schedule.index') }}">スケジュール</a>
                  <a class="print-group btn block btn-default btn-sm" href="{{ route('negotiate.student.index') }}">奨学生の検索</a>
                  <a class="print-group btn block btn-default btn-sm" href="{{ route('negotiate.history.index') }}">交渉の検索</a>
                </div>
                <!-- / .fl -->
                <div class="fl w49">
                  <a class="print-group btn block btn-default btn-sm" href="{{ route('negotiate.leger_sheet.index') }}">各種帳票作成</a>
                  <a class="print-group btn block btn-default btn-sm" href="{{ route('negotiate.search_history.index') }}">検索履歴</a>
                  <a class="print-group btn block btn-default btn-sm" href="{{ route('negotiate.prescription.edit') }}">消滅時効期限の設定</a>
                </div>
                <!-- / .fl -->
              </div>
              <!-- / . -->
            </div>
            <!-- / .tab-pane#contentE -->
            @endcan

            @can('master')
            <div class="tab-pane @if($active == 'master') active @endif " id="contentF">
              <div class="clearfix">
                <div class="fl w49 m_r2">
                  <div class="title">共通</div>
                  <a class="print-group btn block btn-default btn-sm" href="{{ route('master.bank.index') }}">銀行店舗マスタ</a>
                  <a class="print-group btn block btn-default btn-sm" href="{{ route('master.university.index') }}">大学マスタ</a>
                  <a class="print-group btn block btn-default btn-sm" href="{{ route('master.high_school.index') }}">高校マスタ</a>
                  <a class="print-group btn block btn-default btn-sm" href="{{ route('master.junior_high_school.index') }}">中学校マスタ</a>
                  <a class="print-group btn block btn-default btn-sm" href="{{ route('master.arrear_interest_rate.edit') }}">滞納金の利率変更</a>
                  <a class="print-group btn block btn-default btn-sm" href="{{ route('master.name.edit') }}">各種名称の修正</a>
                  <a class="print-group btn block btn-default btn-sm" href="{{ route('master.stamp_duty.edit') }}">印紙税マスタ</a>
                  <a class="print-group btn block btn-default btn-sm" href="{{ route('master.municipality.index') }}">市町村マスタ</a>
                  <a class="print-group btn block btn-default btn-sm" href="{{ route('master.zip_code.index') }}">郵便番号マスタ</a>
                  <a class="print-group btn block btn-default btn-sm" href="{{ route('master.date_conversion.index') }}">日付変換マスタ</a>
                  <a class="print-group btn block btn-default btn-sm" href="{{ route('master.document.index') }}">各出力文書の修正</a>
                </div>
                <!-- / .fl -->

                <div class="fl w49">
                  <div class="title">高校</div>
                  <a class="print-group btn block btn-default btn-sm" href="{{ route('master.monthly_lending.high_school.index') }}">貸与月額 (高校)</a>
                  <a class="print-group btn block btn-default btn-sm" href="{{ route('master.income_criterion.high_school.index') }}">収入基準マスタ (高校)</a>
                  <a class="print-group btn block btn-default btn-sm" href="{{ route('master.exchequer_judgement.index')  }}">国庫補助審査用マスタ (第1類・第2類基準額、教育扶助)</a>
                  <a class="print-group btn block btn-default btn-sm" href="{{ route('master.basic_deduction.high_school.index')  }}">基礎控除 (高校)</a>
                  <a class="print-group btn block btn-default btn-sm" href="{{ route('master.income_calculation.index')  }}">給与所得計算マスタ</a>
                  <a class="print-group btn block btn-default btn-sm" href="{{ route('master.segmentation.high_school.edit') }}">ブロック管理</a>

                  <div class="title m_o10">大学</div>
                  <a class="print-group btn block btn-default btn-sm" href="{{ route('master.monthly_lending.university.edit') }}">貸与月額 (大学)</a>
                  <a class="print-group btn block btn-default btn-sm" href="{{ route('master.income_criterion.university.index') }}">収入基準マスタ (大学)</a>
                  <a class="print-group btn block btn-default btn-sm" href="{{ route('master.minimum_repayment.edit') }}">返還金最低限度額マスタ</a>
                  <a class="print-group btn block btn-default btn-sm" href="{{ route('master.segmentation.university.edit') }}">ブロック管理</a>
                </div>
                <!-- / .fl -->

                <div class="fl w49">
                  <div class="title m_o10">進学</div>
                  <a class="print-group btn block btn-default btn-sm" href="{{ route('master.lending.shingaku.index') }}">貸与額 (進学)</a>
                  <a class="print-group btn block btn-default btn-sm" href="{{ route('master.income_criterion.shingaku.index') }}">収入基準マスタ (進学)</a>
                  <a class="print-group btn block btn-default btn-sm" href="{{ route('master.shingaku_school.index') }}">学校マスタ (進学)</a>
                  <a class="print-group btn block btn-default btn-sm" href="{{ route('master.social_relief_criterion.index') }}">定例免除の生活保護基準</a>
                  <a class="print-group btn block btn-default btn-sm" href="{{ route('master.deduction.shingaku.index') }}">基礎控除・特別控除 (進学)</a>
                  <a class="print-group btn block btn-default btn-sm" href="{{ route('master.minimum_repayment.edit') }}">返還金最低限度マスタ一覧</a>
                </div>
                <!-- / .fl -->
              </div>
              <!-- / . -->
            </div>
            <!-- / .tab-pane#contentF -->
            @endcan

          </div>
          <!-- / .tab-content -->
        </div>
        <!-- / .panel-body -->
      </div>
      <!-- / .panel panel-default -->


@endsection
