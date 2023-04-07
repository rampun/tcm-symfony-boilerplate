<template>
  <b-card>
    <b-form @submit.stop.prevent="onSubmit">
      <b-form-row>
        <b-col md="12">
          <b-form-group
            id="input-group-comment"
            :label="$t('common.comment.comment.label_required')"
            label-for="input-comment"
          >
            <b-form-input
              id="input-comment"
              v-model="form.text"
              type="text"
              :placeholder="$t('common.comment.comment.placeholder')"
              autofocus
              trim
              required
              :state="formState('text')"
            />
            <b-form-invalid-feedback :state="formState('text')">
              <ErrorsList :errors="formErrors('text')" />
            </b-form-invalid-feedback>
          </b-form-group>
        </b-col>
      </b-form-row>
      <b-button type="submit" variant="primary">
        {{ $t('common.create') }}
      </b-button>
    </b-form>
  </b-card>
</template>

<script>
import ErrorsList from '@/components/forms/ErrorsList'
import { Form } from '@/mixins/form'
import { CreateCommentMutation } from '@/graphql/comments/create_comment.mutation'
import { GlobalOverlay } from '@/mixins/global-overlay'
import { GenericToast } from '@/mixins/generic-toast'

export default {
  components: { ErrorsList },
  mixins: [Form, GlobalOverlay, GenericToast],
  layout: 'dashboard',
  data() {
    return {
      form: {
        text: '',
      },
    }
  },
  methods: {
    async onSubmit() {
      this.resetFormErrors()
      this.displayGlobalOverlay()

      console.log(this.form.text)
      try {
        const result = await this.$graphql.request(CreateCommentMutation, {
          text: this.form.text,
        })

        this.genericSuccessToast()

        this.$router.push(
          this.localePath({
            name: 'dashboard-comment-id',
            params: { id: result.createComment.id },
          })
        )
      } catch (e) {
        this.hydrateFormErrors(e)
      } finally {
        this.hideGlobalOverlay()
      }
    },
  },
}
</script>
