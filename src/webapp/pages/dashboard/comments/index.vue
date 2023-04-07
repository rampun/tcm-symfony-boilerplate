<template>
  <div>
    <div class="m-auto mr-sm-0 ml-sm-auto text-right">
      <b-button
        variant="primary"
        :to="localePath({ name: 'dashboard-comments-create' })"
        >{{ $t('common.create') }}</b-button
      >
    </div>
    <b-card class="mt-3">
      <b-table hover :responsive="true" :items="items" :fields="fields">
        <template #cell(actions)="data">
          <b-button
            size="sm"
            variant="primary"
            :aria-label="$t('common.edit')"
            :to="
              localePath({
                name: 'dashboard-comments-id',
                params: { id: data.item.id },
              })
            "
          >
            <b-icon icon="pencil"></b-icon>
          </b-button>
        </template>
        <template #table-busy>
          <div class="text-center my-2">
            <b-spinner class="align-middle" variant="primary"></b-spinner>
          </div>
        </template>
      </b-table>
    </b-card>
  </div>
</template>

<script>
import { CommentsQuery } from '@/graphql/comments/comments.query'

export default {
  layout: 'dashboard',
  async asyncData(context) {
    try {
      const result = await context.app.$graphql.request(CommentsQuery, {
        search: '',
        limit: 20,
        offset: 0,
      })
      return {
        items: result.comments.items,
      }
    } catch (e) {
      context.error(e)
    }
  },
  data() {
    return {
      fields: [
        {
          key: 'text',
          label: this.$t('common.comment.comment.label'),
        },
        {
          key: 'actions',
          label: this.$t('common.list.actions'),
        },
      ],
    }
  },
}
</script>
