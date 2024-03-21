import { ForwardedRef, LegacyRef, forwardRef } from 'react'
import styles from './Input.module.css'
import { useNumberFormat } from '@react-input/number-format'

interface Props extends React.DetailedHTMLProps<React.InputHTMLAttributes<HTMLInputElement>, HTMLInputElement> {
  htmlFor: string,
  containerClassName?: string,
  labelClassName?: string,
  label: string
  errorMessages?: string[]
  errorClassname?: string
  currency?: boolean
}

const Input = (props:Props) => {
  const { label, type, currency, htmlFor, labelClassName, containerClassName, errorClassname, errorMessages, ...restProps } = props

  const rupiahMask = useNumberFormat({
    locales: 'id',
    maximumFractionDigits: 0,
    currency: 'IDR',
    format: 'currency',
    currencyDisplay: 'symbol',
  })

  return (
    <div className={`${styles.inputContainer}${containerClassName ? ` ${containerClassName}` : ''}`}>
      <input
        ref={currency ? rupiahMask : undefined}
        name={htmlFor || props.id || props.name}
        id={htmlFor || props.id || props.name}
        type={type} className={`peer ${styles.inputField}${props.className ? ` ${props.className}` : ''}`} {...restProps} />
      <label
        htmlFor={htmlFor}
        className={`${styles.labelBox} 
        peer-placeholder-shown:translate-y-2.5 peer-placeholder-shown:text-base 
         text-base
        peer-placeholder-shown:text-gray-500 peer-focus:ml-1 peer-focus:-translate-y-3 
        peer-focus:px-1${labelClassName ? ` ${labelClassName}` : ''}
        ${props.required ? ` ${styles.required}` : ''}`}
      >
        {label}
      </label>
      {
        errorMessages?.length ? (
          <div>
            {errorMessages.map((message, index) => (
              <p key={index} className={`${styles.error}${errorClassname ? ` ${errorClassname}` : ''}`}>{message}</p>
            ))}
          </div>
        ) : <></>
      }
    </div>
  )
}

export default Input