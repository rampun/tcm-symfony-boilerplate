<template>
  <div>
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
          {{ $t('common.update') }}
        </b-button>
      </b-form>
    </b-card>
    <b-card v-if="!selfUpdate" class="mt-3" border-variant="danger">
      <ConfirmDelete :on-confirm="onDelete" />
    </b-card>
  </div>
</template>

<script>
import { CommentQuery } from '@/graphql/comments/comment.query'
import { UpdateCommentMutation } from '@/graphql/comments/update_comment.mutation'
import { Form } from '@/mixins/form'
import { Roles } from '@/mixins/roles'
import { Locales } from '@/mixins/locales'
import { GlobalOverlay } from '@/mixins/global-overlay'
import { Auth } from '@/mixins/auth'
import { Images } from '@/mixins/images'
import { GenericToast } from '@/mixins/generic-toast'
import ErrorsList from '@/components/forms/ErrorsList'
import { DeleteCommentMutation } from '@/graphql/comments/delete_comment.mutation'
import ConfirmDelete from '@/components/forms/ConfirmDelete'

export default {
  components: { ConfirmDelete, ErrorsList },
  mixins: [Form, Roles, Locales, GlobalOverlay, Auth, Images, GenericToast],
  layout: 'dashboard',
  async asyncData(context) {
    try {
      const result = await context.app.$graphql.request(CommentQuery, {
        id: context.params.id,
      })

      return {
        form: {
          text: result.comment.text,
        },
      }
    } catch (e) {
      context.error(e)
    }
  },
  data() {
    return {
      form: {
        text: '',
      },
    }
  },

  computed: {
    selfUpdate() {
      return this.user.id === this.$route.params.id
    },
  },
  methods: {
    async onSubmit() {
      this.resetFormErrors()
      this.displayGlobalOverlay()

      try {
        const result = await this.$graphql.request(UpdateCommentMutation, {
          id: this.$route.params.id,
          text: this.form.text,
        })

        this.genericSuccessToast()

        // Same user as authenticated one.
        if (this.selfUpdate) {
          this.setComment(result.updateComment)
        }
      } catch (e) {
        this.hydrateFormErrors(e)
      } finally {
        this.hideGlobalOverlay()
      }
    },
    async onDelete() {
      this.displayGlobalOverlay()

      try {
        await this.$graphql.request(DeleteCommentMutation, {
          id: this.$route.params.id,
        })

        this.genericSuccessToast()
        this.$router.push(this.localePath({ name: 'dashboard-comments' }))
      } catch (e) {
        this.$nuxt.error(e)
      } finally {
        this.hideGlobalOverlay()
      }
    },
  },
}
</script>
