import { gql } from 'graphql-request'
import { CommentFragment } from '@/graphql/auth/comment.fragment'

export const UpdateCommentMutation = gql`
  mutation updateComment($id: String!, $text: String!) {
    updateComment(comment: { id: $id }, text: $text) {
      ...CommentFragment
    }
  }
  ${CommentFragment}
`
