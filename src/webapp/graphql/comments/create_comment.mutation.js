import { gql } from 'graphql-request'
import { CommentFragment } from '@/graphql/auth/comment.fragment'

export const CreateCommentMutation = gql`
  mutation createComment($text: String!) {
    createComment(text: $text) {
      ...CommentFragment
    }
  }
  ${CommentFragment}
`
