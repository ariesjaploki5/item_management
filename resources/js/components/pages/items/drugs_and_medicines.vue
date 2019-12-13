<template>
  <div>
    <table class="table table-sm table-hover">
    <thead>
        <tr>
        <th width="6%">Item ID</th>
        <th width="30%">Description</th>
        <th class="text-center" width="6%">Homis Stock</th>
        <th class="text-center" width="6%">MMO Stock</th>
        <th witdh="6%">Batch No</th>
        <th width="12%">Brand</th>
        <th witdh="8%">Expiration Date</th>
        <th witdh="6%">Cost</th>
        <th class="text-center" width="8%">Action</th>
        </tr>
    </thead>
    <tbody>
        <tr v-for="item in items" :key="item.item_id">
        <td>{{ item.item_id }}</td>
        <td>{{ item.item_desc }}</td>
        <td class="text-right">{{ item.homis_stock }}</td>
        <td class="text-right">{{ item.mmo_stock }}</td>
        <td>
            <div class="row mr-1 ml-1" v-for="batch in item.batches" :key="batch.batch_no">
            {{ batch.batch_no }}
            </div>
        </td>
        <td>
            <div class="row mr-1 ml-1" v-for="batch in item.batches" :key="batch.batch_no">
            {{ batch.brand_desc }}
            </div>
        </td>
        <td>
            <div class="row mr-1 ml-1" v-for="batch in item.batches" :key="batch.batch_no">
            {{ batch.expiration_date }}
            </div>
        </td>
        <td>
            <div class="row mr-1 ml-1" v-for="batch in item.batches" :key="batch.batch_no">
            {{ batch.cost }}
            </div>
        </td>
        <td>
        </td>
        </tr>
    </tbody>
    </table>
  </div>
</template>

<script>
export default {

}
</script>

<style>

</style>